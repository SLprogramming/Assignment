<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $latestProducts = \App\Models\Product::where(function($q) {
        $q->whereNull('discount_percentage')->orWhere('discount_percentage', 0);
    })->latest()->take(10)->get();
    return view('welcome', compact('latestProducts'));
});

// Public Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function() { return redirect('/admin/dashboard'); });
    Route::get('/admin/dashboard', function () { 
        $recentOrders = \App\Models\Order::with(['user'])->latest()->take(5)->get();
        $totalSales = \App\Models\Order::where('status', 'completed')->sum('total_price');
        $orderCount = \App\Models\Order::count();
        $customerCount = \App\Models\User::count();
        return view('admin.dashboard', compact('recentOrders', 'totalSales', 'orderCount', 'customerCount')); 
    });
    Route::resource('admin/products', ProductController::class)->names('admin.products');
    Route::resource('admin/categories', CategoryController::class)->names('admin.categories');
});

// Admin UI Previews
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin']);




// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'webRegister']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'webLogin']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'webLogout'])->name('logout');
    
    // Cart Routes
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'store'])->name('cart.add');
    Route::patch('/cart/{cartItem}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    
    // Order Routes
    Route::post('/checkout', [App\Http\Controllers\OrderController::class, 'store'])->name('checkout.store');

    // Wishlist Routes
    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

// Admin Routes (Updated)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('admin.orders.index');
    Route::patch('/admin/orders/{order}', [App\Http\Controllers\OrderController::class, 'update'])->name('admin.orders.update');
});
