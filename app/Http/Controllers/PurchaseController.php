<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya user yang terautentikasi yang dapat mengakses
        $this->middleware('auth');
    }

    /**
     * Menyimpan data pembelian, baik untuk single item maupun semua item di keranjang.
     */
    public function store(Request $request)
    {
        // Validasi field-field umum dari form
        $validated = $request->validate([
            'full_name'     => 'required|string|max:255',
            'phone_number'  => 'required|string|max:20',
            'address'       => 'required|string',
            'bank_name'     => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'purchase_type' => 'required|string', // 'single' atau 'all'
        ]);

        // Proses upload file bukti transfer
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        if ($request->purchase_type === 'all') {
            // Proses pembelian untuk seluruh item di keranjang
            $cartItems = Cart::with('book')->where('user_id', Auth::id())->get();
            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Keranjang belanja Anda kosong.');
            }

            $totalPrice   = 0;
            $bookNames    = [];
            $totalQuantity = 0;
            foreach ($cartItems as $item) {
                $totalPrice   += $item->book->harga * $item->quantity;
                $bookNames[]  = $item->book->judul . " (" . $item->quantity . ")";
                $totalQuantity += $item->quantity;
            }
            // Menggabungkan judul buku dan jumlahnya menjadi satu string
            $aggregatedBookName = implode(", ", $bookNames);

            // Buat record Purchase untuk pembelian seluruh keranjang
            $purchase = Purchase::create([
                'user_id'       => Auth::id(),
                'book_name'     => $aggregatedBookName,
                'quantity'      => $totalQuantity,
                'total_price'   => $totalPrice,
                'full_name'     => $validated['full_name'],
                'phone_number'  => $validated['phone_number'],
                'address'       => $validated['address'],
                'bank_name'     => $validated['bank_name'],
                'payment_proof' => $path,
                'status'        => 'Belum Diproses', // Status default
            ]);

            // Setelah pembelian berhasil, kosongkan keranjang pengguna
            Cart::where('user_id', Auth::id())->delete();

            return redirect()->back()->with('success', 'Pembelian seluruh keranjang berhasil dilakukan!');
        } else {
            // Proses pembelian untuk single item
            $validatedSingle = $request->validate([
                'book_name'   => 'required|string',
                'total_price' => 'required',
                'quantity'    => 'required|integer|min:1',
            ]);

            // Bersihkan format total_price (menghapus "Rp. " dan karakter non-angka)
            $totalPrice = preg_replace('/[^0-9]/', '', $validatedSingle['total_price']);

            $purchase = Purchase::create([
                'user_id'       => Auth::id(),
                'book_name'     => $validatedSingle['book_name'],
                'quantity'      => $request->input('quantity'),
                'total_price'   => $totalPrice,
                'full_name'     => $validated['full_name'],
                'phone_number'  => $validated['phone_number'],
                'address'       => $validated['address'],
                'bank_name'     => $validated['bank_name'],
                'payment_proof' => $path,
                'status'        => 'pending',
            ]);

            // Hapus item yang dibeli dari keranjang
            Cart::where('user_id', Auth::id())
                ->whereHas('book', function ($query) use ($validatedSingle) {
                    $query->where('judul', $validatedSingle['book_name']);
                })->delete();

            return redirect()->back()->with('success', 'Pembelian berhasil dilakukan!');
        }
    }
}
