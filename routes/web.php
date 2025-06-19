<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController; // Adjust if using Breeze/Jetstream
use App\Http\Controllers\Auth\RegisterController; // Adjust if using Breeze/Jetstream

// Owner Controllers
use App\Http\Controllers\Owner\AdminManagementController;
use App\Http\Controllers\Owner\BuyerManagementController;
use App\Http\Controllers\Owner\ProductManagementController as OwnerProductManagementController;
use App\Http\Controllers\Owner\SalesReportController;
use App\Http\Controllers\Owner\TransactionReportController;

// Admin Controllers
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BuyerController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\AdminSalesReportController;

// Buyer Controllers
use App\Http\Controllers\Buyer\ProductCatalogController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\CheckoutController;
use App\Http\Controllers\Buyer\TransactionHistoryController;
use App\Http\Controllers\Buyer\DashboardController;
use App\Http\Controllers\Buyer\ProductController;




// Authentication Routes (if not using Breeze/Jetstream, otherwise these are often handled by the package)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', [HomeController::class, 'index'])->name('home');

// --- Owner Routes ---
Route::middleware(['auth', 'owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', function () { return view('owner.dashboard'); })->name('dashboard');

    // Product Management
    Route::resource('products', OwnerProductManagementController::class);

    // Admin Management
    Route::resource('admins', AdminManagementController::class)->except(['show']); // Only CRUD for admins

    // Buyer Management
    Route::get('buyers', [BuyerManagementController::class, 'index'])->name('buyers.index');
    Route::get('buyers/{user}/edit', [BuyerManagementController::class, 'edit'])->name('buyers.edit');
    Route::put('buyers/{user}', [BuyerManagementController::class, 'update'])->name('buyers.update');
    Route::delete('buyers/{user}', [BuyerManagementController::class, 'destroy'])->name('buyers.destroy');

    // Sales and Transaction Reports
    Route::get('reports/sales', [SalesReportController::class, 'index'])->name('reports.sales');
    Route::get('reports/transactions', [TransactionReportController::class, 'index'])->name('reports.transactions');
    
});

// --- Admin Routes ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');

    // Product Management (CRUD)
    Route::resource('products', AdminProductController::class);

    // Buyer List
    Route::get('buyers', [BuyerController::class, 'index'])->name('buyers.index');

    // Sales Input
    Route::get('sales/create', [SalesController::class, 'create'])->name('sales.create');
    Route::post('sales', [SalesController::class, 'store'])->name('sales.store');
    Route::get('sales/{transaction}', [SalesController::class, 'show'])->name('sales.show');

    // Sales Report
    Route::get('reports/sales', [AdminSalesReportController::class, 'index'])->name('reports.sales');
});

// --- Buyer Routes ---
Route::middleware(['auth', 'pembeli'])->prefix('buyer')->name('buyer.')->group(function () {
    Route::get('/dashboard', function () { return view('buyer.dashboard'); })->name('dashboard');

    // Product Catalog
    Route::get('products', [ProductCatalogController::class, 'index'])->name('products.index');
    Route::get('products/{product}', [ProductCatalogController::class, 'show'])->name('products.show');

    // Cart
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // Transaction History
    Route::get('transactions', [TransactionHistoryController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{transaction}', [TransactionHistoryController::class, 'show'])->name('transactions.show');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
});

// Fallback for authenticated users without specific role route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->isOwner()) {
            return redirect()->route('owner.dashboard');
        } elseif (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->isPembeli()) {
            return redirect()->route('buyer.dashboard');
        }
        return view('dashboard'); // A generic dashboard if none of the above
    })->name('dashboard');
});