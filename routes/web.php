<?php

use App\Http\Controllers\{
    CategoryController,
    DashboardController,
    ExpenseController,
    ProfileController,
    UserController,
    FoodController,
    InvoiceController,
    OfferController,
    PosController,
    ReportController
};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //----------------------
    Route::post('profile/update/', [UserController::class, 'profileUpdate']);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('foods', FoodController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('offers', OfferController::class);
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::put('category/update-order', [CategoryController::class, 'updateCategoryOrder']);
    Route::controller(OfferController::class)->group(function () {
        Route::put('offer/update-order', 'updateOfferOrder');
        Route::get('offers/{offer}/edit', 'edit');
    });
    Route::controller(PosController::class)->group(function () {
        Route::get('pos', 'index')->name('sale.index');
        Route::post('pay', 'pay');
    });
    Route::get('reports/expenses', [ReportController::class, 'expenses']);
    Route::get('reports/invoices', [ReportController::class, 'invoices']);
    Route::post('reports/invoices/download', [ReportController::class, 'downloadInvoices']);
    Route::post('reports/expenses/download', [ReportController::class, 'downloadExpenses']);
    Route::get('getCategories', [FoodController::class, 'getCategories']);
});
require __DIR__ . '/auth.php';
