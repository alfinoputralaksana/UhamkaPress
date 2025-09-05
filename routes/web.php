<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\PurchaseController;



/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/category/{id}', [IndexController::class, 'showdetail'])->name('category.showdetail');
Route::get('/book/{id}', [IndexController::class, 'detailbuku'])->name('index.detail');
Route::get('/search', [IndexController::class, 'searchbook'])->name('user.search');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);






Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
    Route::get('/home/contact', [HomeController::class, 'contact_user'])->name('user.contact');
    Route::get('/home/about', [HomeController::class, 'about_user'])->name('user.about');
// routes/web.php
Route::get('/home/book/{id}', [HomeController::class, 'detail'])->name('book.detail');
Route::get('/home/search', [HomeController::class, 'search'])->name('books.search');
// routes/web.php
Route::post('/home/purchase', [HomeController::class, 'input_pembelian'])->name('pembelian.store');
    Route::get('/home/pesanan', [HomeController::class, 'index_pesanan'])->name('pesanan.index');
    Route::patch('/home/pesanan/{id}', [HomeController::class, 'update_pesanan'])->name('pesanan.update');
    Route::get('/home/category/{id}', [HomeController::class, 'showdetail_user'])->name('category.show');

   


    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/home/keranjang', [CartController::class, 'showCart'])->name('cart.show');
Route::delete('/home/keranjang/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/purchase', [PurchaseController::class, 'store'])->name('purchase.store');



    Route::get('/home/settings', [AccountSettingsController::class, 'showSettingsForm'])->name('account.settings');
Route::post('/home/settings', [AccountSettingsController::class, 'updatePassword'])->name('account.updatePassword');


});



Route::middleware('redirect_if_not_admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index_dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/kategori', [AdminController::class, 'index_category'])->name('admin.kategori.index');
    Route::post('/admin/kategori', [AdminController::class, 'store_category'])->name('admin.kategori.store');
    Route::get('/admin/kategori/{id}/edit', [AdminController::class, 'edit_category'])->name('admin.kategori.edit');
    Route::put('/admin/kategori/{id}', [AdminController::class, 'update_category'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/{id}', [AdminController::class, 'destroy_category'])->name('admin.kategori.destroy');
    Route::get('/admin/buku', [AdminController::class, 'index_buku'])->name('admin.buku');
    Route::post('/admin/buku', [AdminController::class, 'store_buku'])->name('admin.buku.store');
    Route::get('/admin/buku/{id}/edit', [AdminController::class, 'edit_buku'])->name('admin.buku.edit');
    Route::put('/admin/buku/{book}', [AdminController::class, 'update_buku'])->name('admin.buku.update');
    Route::delete('/admin/buku/{book}', [AdminController::class, 'destroy_buku'])->name('admin.buku.destroy');
    Route::get('/admin/penjualan', [AdminController::class, 'index_penjualan'])->name('admin.penjualan');
    Route::put('/admin/purchase/{id}', [AdminController::class, 'update_penjualan'])->name('admin.purchase.update');
});