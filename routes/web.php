<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DepenseRecurrenteController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ObjectifMensuelController;
use App\Http\Controllers\SavingsGoalController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckIfUser;


Route::get('/', [HomeController::class, 'redirect'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/pro', [ProfileController::class, 'edit'])->name('profile.edit.pro');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

Route::resource('categories', CategorieController::class);
Route::resource('depenses', DepenseController::class);
Route::resource('DepenseRecurrentes', DepenseRecurrenteController::class);
Route::resource('Wishlist', WishlistController::class);


Route::middleware(['auth', CheckIfAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/categories', [CategorieController::class, 'index'])->name('admin.categories');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::resource('categories', CategorieController::class);
});


Route::middleware(['auth'])->group(function () {
   // Route::get('/User/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('/User/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::post('/User/salary/update/{user_id}', [UserController::class, 'AddMensuelalaire'])->name('Salaire.Store');
    Route::get('/expenses/index', [UserController::class, 'Showexpense'])->name('user.expense');
    Route::post('/user/sidehustle/store', [UserController::class, 'StoreSideHustle']);
    
    // Routes pour les Saving goals 
    Route::post('/objectifs', [ObjectifMensuelController::class, 'store'])->name('objectifs.store');
    Route::put('/objectifs/{id}', [ObjectifMensuelController::class, 'update'])->name('objectifs.update');
    Route::delete('/objectifs/{id}', [ObjectifMensuelController::class, 'destroy'])->name('objectifs.destroy');
    Route::post('/savings-goals', [SavingsGoalController::class, 'store'])->name('savings-goals.store');
    Route::put('/savings-goals/{id}', [SavingsGoalController::class, 'update'])->name('savings-goals.update');
    Route::delete('/savings-goals/{id}', [SavingsGoalController::class, 'destroy'])->name('savings-goals.destroy');


    // Routes pour les Wishlist
    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [App\Http\Controllers\WishlistController::class, 'store'])->name('wishlist.store');
    Route::put('/wishlist/{id}', [App\Http\Controllers\WishlistController::class, 'update'])->name('wishlist.update');
    Route::delete('/wishlist/{id}', [App\Http\Controllers\WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

// Route::get('/admin/dashboard', function () {
//     echo "hello admi";
// })->middleware('role:admin');

require __DIR__.'/auth.php';
