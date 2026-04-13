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

// Static Pages
Route::get('/p/{page:slug}', function (\App\Models\Page $page) {
    if (!$page->is_published) abort(404);
    return view('pages.static', compact('page'));
})->name('pages.show');

// Articles
Route::get('/artikel', [App\Http\Controllers\ArticleController::class, 'index'])->name('article.index');
Route::get('/artikel/{article:slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');
Route::post('/artikel/{article}/track-click', [App\Http\Controllers\ArticleController::class, 'trackClick'])->name('article.track-click');

// Contact
Route::get('/kontak', function () {
    return view('pages.contact');
})->name('contact');

// Auth
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Admin Dashboard & Management
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/articles', App\Http\Controllers\Admin\ArticleController::class)->names('admin.articles')->parameters(['articles' => 'article']);
    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class)->names('admin.categories');
    Route::get('/traffic', [App\Http\Controllers\Admin\TrafficController::class, 'index'])->name('admin.traffic.index');

    // Footer Settings
    Route::get('/footer', [App\Http\Controllers\Admin\FooterSettingController::class, 'edit'])->name('admin.footer.edit');
    Route::put('/footer', [App\Http\Controllers\Admin\FooterSettingController::class, 'update'])->name('admin.footer.update');

    // Custom Pages (Privacy, Terms, etc)
    Route::resource('/pages', App\Http\Controllers\Admin\PageController::class)->names('admin.pages');
});

// Business Profile (MUST BE AT THE BOTTOM)
Route::get('/{slug}', [BusinessProfileController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('business.profile');
