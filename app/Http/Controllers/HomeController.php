<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data kategori
        $categories = Category::all();
        $books = Book::all(); // Mengambil semua produk dari database
        return view('user.home', compact('books','categories'));
    }

    public function detail($id)
{
    // Mengambil buku berdasarkan ID
    $book = Book::findOrFail($id);
    // Ambil data kategori
    $categories = Category::all();

    // Mengirimkan data buku ke view
    return view('user.detail_buku', compact('book','categories'));
}

public function contact_user()
{
    // Ambil data kategori
    $categories = Category::all();
    $books = Book::all(); // Mengambil semua produk dari database
    return view('user.contact_user', compact('books','categories'));
}

public function about_user()
    {
        // Ambil data kategori
        $categories = Category::all();
        $books = Book::all(); // Mengambil semua produk dari database
        return view('user.about_user', compact('books','categories'));
    }

    public function showdetail_user($id)
    {
        // Ambil kategori berdasarkan ID
        $categories = Category::all();
        $category = Category::findOrFail($id);
        // Ambil produk yang termasuk dalam kategori ini
        $products = Book::where('kategori_id', $id)->get();

        // Kirim data ke tampilan
        return view('user.categorydetail', compact('category','categories', 'products'));
    }

    public function input_pembelian(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'book_name' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'total_price' => 'required|string',
        'full_name' => 'required|string',
        'phone_number' => 'required|numeric',
        'address' => 'required|string',
        'bank_name' => 'required|string',
        'payment_proof' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
    ]);

    // Simpan bukti transfer jika ada
    $paymentProofPath = null;
    if ($request->hasFile('payment_proof')) {
        // Simpan file bukti pembayaran ke folder 'payment_proofs'
        $paymentProofPath = $request->file('payment_proof')->store('public/payment_proofs');
    }

    // Cari buku berdasarkan nama
    $book = Book::where('judul', $validatedData['book_name'])->first();
    if (!$book) {
        return response()->json(['message' => 'Buku tidak ditemukan.'], 404);
    }

    // Coba mengurangi stok
    if (!$book->reduceStock($validatedData['quantity'])) {
        return response()->json(['message' => 'Stok tidak cukup.'], 400);
    }

    // Simpan pembelian ke database
    Purchase::create([
        'user_id' => $validatedData['user_id'],
        'book_name' => $validatedData['book_name'],
        'quantity' => $validatedData['quantity'],
        'total_price' => $validatedData['total_price'],
        'full_name' => $validatedData['full_name'],
        'phone_number' => $validatedData['phone_number'],
        'address' => $validatedData['address'],
        'bank_name' => $validatedData['bank_name'],
        'payment_proof' => $paymentProofPath,
        'status' => 'Belum Diproses',
    ]);

    return response()->json(['success' => true]);
}


    public function index_pesanan()
    {
        // Ambil data pesanan sesuai dengan user yang sedang login
        $user = Auth::user();
        // Ambil data kategori
        $categories = Category::all();
        $pesanan = Purchase::where('user_id', $user->id)->get();

        // Kirim data pesanan ke view
        return view('user.pesanan', compact('pesanan','categories'));
    }

    public function update_pesanan($id)
    {
        // Temukan pesanan berdasarkan ID
        $pesanan = Purchase::findOrFail($id);

        // Perbarui status pesanan
        $pesanan->status = 'Diterima';
        $pesanan->save();

        // Kembali ke daftar pesanan dengan pesan sukses
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui menjadi Diterima.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::all();

        // Pencarian berdasarkan judul atau pengarang
        $books = Book::where('judul', 'LIKE', "%{$query}%")
            ->orWhere('pengarang', 'LIKE', "%{$query}%")
            ->get();

        // Tampilkan hasil pencarian ke view
        return view('user.search_results_user', compact('books', 'query','categories'));
    }
}
