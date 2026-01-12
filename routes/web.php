<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// All
Route::get('/', [NewsController::class, 'index'])->name('index');
Route::get('/news', [NewsController::class, 'listAllNews'])->name('news.index');
Route::get('/news/{news}/show', [NewsController::class, 'show'])->name('news.show');
Route::post('/news/{news}/like', [LikeController::class, 'likeNews'])->name('news.like');
Route::get('/news/{categories}/category', [NewsController::class, 'viewCategory'])->name('news.viewCategory');
Route::get('/search', [NewsController::class, 'search'])->name('news.search');
Route::get('/storage/images/{filename}', function (string $filename) {
    if (! preg_match('/^[A-Za-z0-9._-]+$/', $filename)) {
        abort(404);
    }

    $relativePath = 'images/'.$filename;
    if (! Storage::disk('public')->exists($relativePath)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($relativePath), [
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->name('storage.images.show');

// Guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login/submit', [LoginController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register/submit', [LoginController::class, 'registerSubmit'])->name('register.submit');
});

// Auth
Route::middleware(['auth', 'online.status'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // CKEditor image upload
    Route::post('/news/upload-image', [NewsController::class, 'uploadImage'])->name('news.uploadImage');
    // News
    Route::get('/news/{news}/view', [NewsController::class, 'view'])->name('news.view');
    // Profile
    Route::resource('profile', UserController::class)->parameters([
        'profile' => 'user',
    ])->only([
        'edit',
        'update',
    ]);
    // Notification
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/count', [NotificationController::class, 'unreadNotificationsCount'])->name('count');
        Route::get('/fetch', [NotificationController::class, 'fetchNotifications'])->name('fetch');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('markAsRead');
    });
});

// Super Admin
Route::middleware(['role:Super Admin'])->group(function () {
    // News
    // Specific routes must come before wildcard routes
    Route::get('/admin/news/manage', [NewsController::class, 'manage'])->name('admin.news.manage');

    Route::resource('admin/news', NewsController::class)->names('admin.news')->only([
        'edit',
        'update',
        'destroy',
    ]);

    // Block direct access to /admin/news/{id} (show route) - must be after specific routes
    Route::get('/admin/news/{news}', function () {
        abort(404);
    });
    // Category
    Route::resource('admin/category', CategoryController::class)->names('admin.category')->only([
        'store',
        'update',
        'destroy',
    ]);
    Route::get('/admin/category/manage', [CategoryController::class, 'manage'])->name('admin.category.manage');
    // Banners
    Route::resource('admin/banners', App\Http\Controllers\BannerController::class)->names('admin.banners');
    Route::patch('/admin/banners/{banner}/toggle-status', [App\Http\Controllers\BannerController::class, 'toggleStatus'])->name('admin.banners.toggleStatus');
    // Users
    Route::resource('admin/users', UserController::class)->only(['index', 'destroy'])
        ->names([
            'index' => 'admin.users.manage',
            'destroy' => 'admin.users.destroy',
        ]);

    Route::patch('/admin/users/{user}/assignRole', [UserController::class, 'assignRole'])->name('admin.users.assignRole');
});

// Editor
Route::group(['middleware' => ['permission:Status News|Update Status News']], function () {
    Route::get('/news/status', [NewsController::class, 'status'])->name('news.status');
    Route::patch('/news/{news}/updatestatus', [NewsController::class, 'updateStatus'])->name('news.updateStatus');
});

// Writer
Route::group(['middleware' => ['permission:Create News|Store News|Edit News|Update News|Draft']], function () {
    Route::resource('news', NewsController::class)->names('news')->only([
        'create',
        'store',
        'edit',
        'update',
    ]);
    Route::get('/news/draft', [NewsController::class, 'draft'])->name('news.draft');
});
