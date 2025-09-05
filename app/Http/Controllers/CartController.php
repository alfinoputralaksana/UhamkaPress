<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan pengguna harus login
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar item di keranjang
     */
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('book')->get();
        return view('cart.index', compact('carts'));
    }

    public function showCart()
{
    // Ambil data keranjang dari session atau database
    $cartItems = Cart::with('book')->where('user_id', auth()->id())->get();
    $categories = Category::all();

    return view('user.keranjang', compact('cartItems','categories'));
}

public function remove($id)
{
    $cartItem = Cart::findOrFail($id);

    // Pastikan hanya user yang memiliki item dapat menghapusnya
    if ($cartItem->user_id !== auth()->id()) {
        return redirect()->route('keranjang')->with('error', 'Tidak diizinkan untuk menghapus item ini.');
    }

    $cartItem->delete();

    return redirect()->route('cart.show')->with('success', 'Item berhasil dihapus dari keranjang.');
}


    /**
     * Menyimpan item ke keranjang (menggunakan database)
     */
    public function store(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'quantity' => 'required|integer|min:1',
    ]);

    try {
        $cart = Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'book_id' => $request->book_id],
            ['quantity' => $request->quantity]
        );
        
        // Jika request adalah AJAX, kembalikan JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil ditambahkan ke keranjang'
            ]);
        }

        return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang');
    } catch (\Exception $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan ke keranjang: ' . $e->getMessage());
    }
}


    /**
     * Menghapus item dari keranjang
     */
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->delete();
            return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
        }
        return redirect()->back()->with('error', 'Item tidak ditemukan');
    }

    /**
     * Menambahkan item ke keranjang (menggunakan session)
     */
    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            // Ambil data keranjang dari session
            $cart = Session::get('cart', []);

            // Tambahkan item ke keranjang
            if (isset($cart[$request->book_id])) {
                $cart[$request->book_id]['quantity'] += $request->quantity;
            } else {
                $cart[$request->book_id] = [
                    'quantity' => $request->quantity,
                ];
            }

            // Simpan keranjang ke session
            Session::put('cart', $cart);

            return response()->json([
                'message' => 'Buku berhasil ditambahkan ke keranjang!',
                'cart' => $cart,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menambahkan ke keranjang!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
