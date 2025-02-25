<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckIfUser;


Route::get('/', [HomeController::class, 'redirect'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', CheckIfAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


Route::middleware(['auth', CheckIfUser::class])->group(function () {
    Route::get('/User/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
});

// Route::get('/admin/dashboard', function () {
//     echo "hello admi";
// })->middleware('role:admin');

require __DIR__.'/auth.php';
