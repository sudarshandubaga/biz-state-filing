<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EntityTypeController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

# Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (not logged in)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::get('forgot-password', [AdminAuthController::class, 'showForgotPassword'])->name('forgot-password');
        Route::post('forgot-password', [AdminAuthController::class, 'forgotPassword']);
        Route::get('reset-password/{token}', [AdminAuthController::class, 'showResetPassword'])->name('reset-password');
        Route::post('reset-password', [AdminAuthController::class, 'resetPassword'])->name('reset-password.post');
    });

    // Authenticated routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('change-password', [AdminAuthController::class, 'showChangePassword'])->name('change-password');
        Route::post('change-password', [AdminAuthController::class, 'changePassword']);
        Route::get('profile', [AdminAuthController::class, 'showEditProfile'])->name('profile');
        Route::put('profile', [AdminAuthController::class, 'updateProfile'])->name('profile.update');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Bulk Actions (must be before resource routes to avoid wildcard matching)
        Route::post('state/bulk-action', [StateController::class, 'bulkAction'])->name('states.bulk-action');
        Route::post('country/bulk-action', [CountryController::class, 'bulkAction'])->name('countries.bulk-action');
        Route::post('entity-type/bulk-action', [EntityTypeController::class, 'bulkAction'])->name('entity-types.bulk-action');
        Route::post('industry/bulk-action', [IndustryController::class, 'bulkAction'])->name('industries.bulk-action');
        Route::post('admin-user/bulk-action', [AdminUserController::class, 'bulkAction'])->name('admin-users.bulk-action');

        // CRUD Resources
        Route::resource('states', StateController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('entity-types', EntityTypeController::class);
        Route::resource('industries', IndustryController::class);

        // Admin Users
        Route::resource('admin-users', AdminUserController::class);

        // Pages
        Route::resource('pages', PageController::class)->only(['index', 'edit', 'update']);

        // Settings
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        // Blog
        Route::resource('blog-categories', BlogCategoryController::class);
        Route::resource('blog-tags', BlogTagController::class);
        Route::post('blogs/upload-image', [BlogController::class, 'uploadEditorImage'])->name('blogs.upload-image');
        Route::resource('blogs', BlogController::class);
    });
});

# Fallback route for auth middleware redirect (admin guard needs a route named 'login')
Route::get('login', function () {
    return redirect()->route('admin.login');
})->name('login');

# Website Routes
Route::get('/', [WebController::class, 'home'])->name('home');

Route::get('/states', [WebController::class, 'states'])->name('web.states');
Route::get('/states/{slug}', [WebController::class, 'stateDetail'])->name('web.state-detail');

Route::get('/entity-types', [WebController::class, 'entityTypes'])->name('web.entity-types');
Route::get('/entity-types/{slug}', [WebController::class, 'entityTypeDetail'])->name('web.entity-type-detail');

Route::get('/industries', [WebController::class, 'industries'])->name('web.industries');
Route::get('/industries/{slug}', [WebController::class, 'industryDetail'])->name('web.industry-detail');

Route::get('/compliance-calendar', function () {
    return view('web.screens.compliance-calendar');
})->name('web.compliance-calendar');

Route::get('/blog', [WebController::class, 'blog'])->name('web.blog');
Route::get('/blog/{slug}', [WebController::class, 'blogDetail'])->name('web.blog-detail');

// Captcha
Route::get('/captcha/image', [CaptchaController::class, 'image'])->name('captcha.image');
Route::get('/captcha/refresh', [CaptchaController::class, 'refresh'])->name('captcha.refresh');

// Contact
Route::get('/contact', [WebController::class, 'contact'])->name('web.contact');
Route::post('/contact', [WebController::class, 'sendContact'])->name('web.contact.send');

// Dynamic Pages (must be at the end to avoid conflicting with other routes)
Route::get('/{slug}', [WebController::class, 'pageDetail'])->name('web.page');
