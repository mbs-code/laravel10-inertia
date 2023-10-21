<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\PasswordForgotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AppController::class, 'view'])->name('app.view');

Route::get('/login', [LoginController::class, 'view'])->name('login.view');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/password-forgot', [PasswordForgotController::class, 'view'])->name('password_forgot.view');
Route::post('/password-forgot', [PasswordForgotController::class, 'store'])->name('password_forgot.store');

Route::get('/password-reset', [PasswordResetController::class, 'view'])->name('password_reset.view');
Route::post('/password-reset', [PasswordResetController::class, 'store'])->name('password_reset.store');

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

    Route::get('/home', [HomeController::class, 'view'])->name('home.view');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';
