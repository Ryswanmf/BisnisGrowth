<?php

use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkRedirectController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');

// Temporary placeholders for other routes
Route::get('/direktori', function () {
    return "Halaman Direktori (Coming Soon)";
})->name('directory.index');

Route::get('/kategori/{slug}', function ($slug) {
    return "Halaman Kategori: " . $slug;
})->name('category.show');

Route::get('/go/{link}', [LinkRedirectController::class, 'redirect'])->name('link.redirect');

// Articles
Route::get('/artikel', [App\Http\Controllers\ArticleController::class, 'index'])->name('article.index');
Route::get('/artikel/{article:slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');

// Contact
Route::get('/kontak', function () {
    return view('pages.contact');
})->name('contact');

// Auth
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Admin Dashboard
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
});

// Business Profile (MUST BE AT THE BOTTOM)
Route::get('/{slug}', [BusinessProfileController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('business.profile');
