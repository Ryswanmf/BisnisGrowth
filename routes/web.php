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

// Business Profile (MUST BE AT THE BOTTOM)
Route::get('/{slug}', [BusinessProfileController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('business.profile');
