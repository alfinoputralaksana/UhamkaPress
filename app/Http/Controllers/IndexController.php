<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        // Ambil data kategori
        $categories = Category::all();
        $books = Book::all(); // Mengambil semua produk dari database
        return view('index', compact('books','categories'));
    }

    public function contact()
    {
        // Ambil data kategori
        $categories = Category::all();
        $books = Book::all(); // Mengambil semua produk dari database
        return view('contact', compact('books','categories'));
    }
    
    public function about()
    {
        // Ambil data kategori
        $categories = Category::all();
        $books = Book::all(); // Mengambil semua produk dari database
        return view('about', compact('books','categories'));
    }

    public function showdetail($id)
    {
        // Ambil kategori berdasarkan ID
        $categories = Category::all();
        $category = Category::findOrFail($id);
        // Ambil produk yang termasuk dalam kategori ini
        $products = Book::where('kategori_id', $id)->get();

        // Kirim data ke tampilan
        return view('categorydetail_index', compact('category','categories', 'products'));
    }

    public function detailbuku($id)
    {
        // Mengambil buku berdasarkan ID
        $book = Book::findOrFail($id);
        // Ambil data kategori
        $categories = Category::all();
    
        // Mengirimkan data buku ke view
        return view('detailbuku_index', compact('book','categories'));
    }

    public function searchbook(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::all();

        // Pencarian berdasarkan judul atau pengarang
        $books = Book::where('judul', 'LIKE', "%{$query}%")
            ->orWhere('pengarang', 'LIKE', "%{$query}%")
            ->get();

        // Tampilkan hasil pencarian ke view
        return view('search_results', compact('books', 'query','categories'));
    }
}
