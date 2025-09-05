<?php

namespace App\Http\Controllers;

use App\Models\Admin; // Ensure this is the correct model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

use App\Models\Book; // Model Buku
use App\Models\Purchase;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index_dashboard()
    {
        // Hitung jumlah admin, buku, dan pesanan
        $jumlahAdmin = Admin::count();
        $jumlahBuku = Book::count();
        $jumlahPesanan = Purchase::count();

        // Kirim semua data ke view menggunakan satu pemanggilan compact()
        return view('admin.dashboard', compact('jumlahBuku', 'jumlahAdmin', 'jumlahPesanan'));
    }

    // Display the list of admins
    public function index()
    {
        $admins = Admin::all(); // Fetch all admins
        return view('admin.users', compact('admins')); // Pass admins to the view
    }

    // Store a new admin
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:admins', // Ensure table name is correct
            'email' => 'required|email|unique:admins', // Ensure table name is correct
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin berhasil ditambahkan');
    }

    // Update an admin
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:admins,username,' . $admin->id, // Ensure table name is correct
            'email' => 'required|email|unique:admins,email,' . $admin->id, // Ensure table name is correct
            'password' => 'nullable|min:6',
        ]);

        $admin->update([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin berhasil diupdate');
    }

    // Delete an admin
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.users.index')->with('success', 'Admin berhasil dihapus');
    }

    // Menampilkan daftar kategori
    public function index_category()
    {
        $categories = Category::all(); // Mengambil semua kategori dari database
        return view('admin.kategori', compact('categories')); // Mengirim data kategori ke view
    }

    // Menyimpan kategori baru
    public function store_category(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->input('kategori'),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan formulir edit kategori
    public function edit_category($id)
    {
        $category = Category::findOrFail($id); // Menampilkan kategori berdasarkan ID
        return view('admin.kategori', compact('category')); // Mengirim data kategori ke view
    }

    // Memperbarui kategori
    public function update_category(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->input('kategori'),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy_category($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function index_penjualan()
    {
        // Mengambil data dari tabel purchase
        $purchases = Purchase::all();


        // Mengirim data ke view
        return view('admin.penjualan', compact('purchases'));
    }


    public function update_penjualan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|string|in:belum di proses,proses,sedang dikirim,ditolak',
        ]);

        // Temukan pembelian berdasarkan ID
        $purchase = Purchase::findOrFail($id);

        // Update status
        $purchase->status = $request->input('status');
        $purchase->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.penjualan')->with('success', 'Status pembelian berhasil diperbarui.');
    }

    public function index_buku()
    {
        $books = Book::with('kategori')->get();
        $categories = Category::all();
        return view('admin.buku', compact('books', 'categories'));
    }

    public function store_buku(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:categories,id',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $this->handleImageUpload($request);

        Book::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit_buku($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit-buku', compact('book', 'categories'));
    }

    public function update_buku(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:categories,id',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $this->handleImageUpload($request, $book->image);

        $book->update([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy_buku(Book $book)
    {
        if ($book->image) {
            Storage::delete('public/' . $book->image);
        }

        $book->delete();

        return redirect()->route('admin.buku')->with('success', 'Buku berhasil dihapus.');
    }

    protected function handleImageUpload(Request $request, $oldImage = null)
{
    if ($request->hasFile('image')) {
        if ($oldImage) {
            Storage::delete('public/' . $oldImage);
        }
        return $request->file('image')->store('books', 'public');
    }

    return $oldImage;
}

}
