<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pages
    Route::get('pages/published/{page}', [PageController::class, 'published'])->name('pages.published');
    Route::resource('pages', PageController::class)->except(['show']);

    // Users
    Route::resource('users', UserController::class)->except(['show']);

    // Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('change-password', [ProfileController::class, 'changePassword'])->name('change-password');

});
