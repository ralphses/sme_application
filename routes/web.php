<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
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

    Route::prefix("business")->group(function () {
        Route::patch('/{id}/status', [BusinessController::class, 'updateStatus'])->name('dashboard.business.updateStatus');
        Route::get("/", [BusinessController::class, 'index'])->name('dashboard.business');
    });

})->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
