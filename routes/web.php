<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function () {
    Route::get("/", [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix("users")->group(function () {
        Route::get("/", [UserController::class, 'index'])->name('dashboard.users');
        Route::patch('/{id}/update-status', [UserController::class, 'updateStatus'])->name('dashboard.users.updateStatus');

    });

    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('dashboard.report');
    });

    Route::prefix("sales")->group(function () {
        Route::get('', [SaleController::class, 'index'])->name('dashboard.sales');
    });

    Route::prefix("employees")->group(function () {
        Route::get("/", [EmployeeController::class, "index"])->name("dashboard.employee");
        Route::get("/add", [EmployeeController::class, "create"])->name("dashboard.employee.add");
        Route::post("/add", [EmployeeController::class, "store"])->name("dashboard.employee.store");
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('dashboard.products');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/create', [ProductController::class, 'store'])->name('products.store');
    });

    Route::prefix("business")->group(function () {
        Route::patch('/{id}/status', [BusinessController::class, 'updateStatus'])->name('dashboard.business.updateStatus');
        Route::get("", [BusinessController::class, 'index'])->name('dashboard.business');
        Route::get("/create", [BusinessController::class, 'create'])->name('dashboard.business.create');
        Route::post("/store", [BusinessController::class, 'store'])->name('dashboard.business.store');

        Route::prefix("orders")->group(function () {
            Route::get('', [SalesOrderController::class, "index"])->name('dashboard.business.order');
            Route::get('new', [SalesOrderController::class, "create"])->name('dashboard.business.order.create');
            Route::post('new', [SalesOrderController::class, "store"])->name('dashboard.business.order.create');
        });
    });

})->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
