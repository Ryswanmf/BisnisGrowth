<?php

use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkRedirectController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);

// Search Redirect (Header Search to Articles)
Route::get('/direktori', function (\Illuminate\Http\Request $request) {
    if ($request->has('q')) {
        return redirect()->route('article.index', ['q' => $request->q]);
    }
    return redirect()->route('article.index');
})->name('directory.index');

Route::get('/kategori/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');

Route::get('/go/{link}', [LinkRedirectController::class, 'redirect'])->name('link.redirect');

// Static Pages
Route::get('/p/{page:slug}', function (\App\Models\Page $page) {
    if (!$page->is_published) abort(404);
    return view('pages.static', compact('page'));
})->name('pages.show');

// Articles
Route::get('/artikel', [App\Http\Controllers\ArticleController::class, 'index'])->name('article.index');
Route::get('/artikel-live-search', [App\Http\Controllers\ArticleController::class, 'liveSearch'])->name('article.live-search');
Route::get('/artikel/{slug}', [App\Http\Controllers\ArticleController::class, 'show'])
    ->name('article.show');
Route::post('/artikel/{article}/track-click', [App\Http\Controllers\ArticleController::class, 'trackClick'])->name('article.track-click');
Route::post('/artikel/{article}/comment', [App\Http\Controllers\ArticleController::class, 'storeComment'])->name('article.comment.store');

// Contact
Route::get('/kontak', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store')->middleware('honeypot');

// Auth
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Admin Dashboard & Management
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');

    // Akses Berdua (Admin & User)
    // Akses Berdua (Admin & User)
Route::middleware(['role:user'])->group(function() {

    // Bulk Article Generator
    Route::get('/articles/bulk', [App\Http\Controllers\Admin\BulkArticleController::class, 'index'])
        ->name('admin.articles.bulk');

    Route::post('/articles/bulk', [App\Http\Controllers\Admin\BulkArticleController::class, 'store'])
        ->name('admin.articles.bulk.store');

    // Articles Resource
    Route::resource('/articles', App\Http\Controllers\Admin\ArticleController::class)
        ->names('admin.articles')
        ->parameters(['articles' => 'article']);

    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class)
        ->names('admin.categories');

    Route::get('/traffic', [App\Http\Controllers\Admin\TrafficController::class, 'index'])
        ->name('admin.traffic.index');
});

    // Akses Khusus (Hanya Admin)
    Route::middleware(['role:admin'])->group(function() {
        Route::resource('/users', App\Http\Controllers\Admin\UserController::class)->names('admin.users');
        Route::get('/messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('admin.messages.index');
        Route::delete('/messages/{message}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('admin.messages.destroy');
        Route::get('/settings/backup', [App\Http\Controllers\Admin\SiteSettingController::class, 'backupDatabase'])->name('admin.settings.backup');
        Route::get('/settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('admin.settings.index');
        Route::put('/settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('admin.settings.update');
        Route::get('/footer', [App\Http\Controllers\Admin\FooterSettingController::class, 'edit'])->name('admin.footer.edit');
        Route::put('/footer', [App\Http\Controllers\Admin\FooterSettingController::class, 'update'])->name('admin.footer.update');
        
        // Custom Pages (Hanya Admin)
        Route::resource('/pages', App\Http\Controllers\Admin\PageController::class)->names('admin.pages');
        Route::resource('/domains', App\Http\Controllers\Admin\DomainController::class)->names('admin.domains');
        Route::resource('/short-keywords', App\Http\Controllers\Admin\ShortKeywordController::class)->names('admin.short-keywords');
        Route::resource('/internal-links', App\Http\Controllers\Admin\InternalLinkController::class)->names('admin.internal-links');
        
    });
});

// SEO & Assets
Route::get('/og-image/{type}/{id}.png', [App\Http\Controllers\OgImageController::class, 'generate'])->name('og.image');

// Business Profile (MUST BE AT THE BOTTOM)
Route::get('/{slug}', [BusinessProfileController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('business.profile');
