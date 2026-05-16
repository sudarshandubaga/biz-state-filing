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
use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Admin\ComplianceDeadlineController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\TaxFormController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessFormationController;
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

        // Leads
        Route::post('lead/bulk-action', [LeadController::class, 'bulkAction'])->name('leads.bulk-action');
        Route::resource('leads', LeadController::class)->only(['index', 'show', 'destroy']);

        // Affiliates
        Route::post('affiliate/bulk-action', [AffiliateController::class, 'bulkAction'])->name('affiliates.bulk-action');
        Route::resource('affiliates', AffiliateController::class);

        // Tax Forms
        Route::resource('tax-forms', TaxFormController::class);

        // Compliance Deadlines
        Route::resource('compliance-deadlines', ComplianceDeadlineController::class);

        // Resources
        Route::resource('resources', \App\Http\Controllers\Admin\ResourceController::class);

        // Ads
        Route::resource('ads', AdController::class);

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

# Business Formation Multi-Step Workflow
Route::prefix('start-llc')->name('formation.')->group(function () {
    Route::get('/', [BusinessFormationController::class, 'index'])->name('start');
    Route::get('/step1', [BusinessFormationController::class, 'step1EntityType'])->name('step1');
    Route::post('/step1', [BusinessFormationController::class, 'postStep1EntityType'])->name('step1.post');
    Route::get('/step2', [BusinessFormationController::class, 'step2State'])->name('step2');
    Route::post('/step2', [BusinessFormationController::class, 'postStep2State'])->name('step2.post');
    Route::get('/step3', [BusinessFormationController::class, 'step3Universal'])->name('step3');
    Route::post('/step3', [BusinessFormationController::class, 'postStep3Universal'])->name('step3.post');
    Route::get('/step4', [BusinessFormationController::class, 'step4Specific'])->name('step4');
    Route::post('/step4', [BusinessFormationController::class, 'postStep4Specific'])->name('step4.post');
    Route::get('/step5', [BusinessFormationController::class, 'step5Review'])->name('step5');
    Route::post('/step5', [BusinessFormationController::class, 'postStep5Review'])->name('step5.post');
    Route::get('/step6', [BusinessFormationController::class, 'step6Matching'])->name('step6');
    Route::post('/step6', [BusinessFormationController::class, 'postStep6Matching'])->name('step6.post');
    Route::get('/step7', [BusinessFormationController::class, 'step7Routing'])->name('step7');
    Route::post('/step7', [BusinessFormationController::class, 'postStep7Routing'])->name('step7.post');
    Route::get('/step8', [BusinessFormationController::class, 'step8Sent'])->name('step8');
    Route::get('/start-over', [BusinessFormationController::class, 'startOver'])->name('start-over');
    Route::get('/go-to-step/{step}', [BusinessFormationController::class, 'goToStep'])->name('go-to-step');
});

# User Authentication Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('verify', [AuthController::class, 'showVerify'])->name('verify');
    Route::post('verify', [AuthController::class, 'verify'])->name('verify.post');
    Route::post('verify/resend', [AuthController::class, 'resendCode'])->name('verify.resend');
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

# Website Routes
Route::get('/', [WebController::class, 'home'])->name('home');

Route::get('/states', [WebController::class, 'states'])->name('web.states');
Route::get('/states/{slug}', [WebController::class, 'stateDetail'])->name('web.state-detail');

Route::get('/entity-types', [WebController::class, 'entityTypes'])->name('web.entity-types');
Route::get('/entity-types/{slug}', [WebController::class, 'entityTypeDetail'])->name('web.entity-type-detail');

Route::get('/industries', [WebController::class, 'industries'])->name('web.industries');
Route::get('/industries/{slug}', [WebController::class, 'industryDetail'])->name('web.industry-detail');

// Forms Library
Route::get('/forms-library', [WebController::class, 'taxForms'])->name('web.forms-library');
Route::get('/tax-forms', [WebController::class, 'onlyTaxForms'])->name('web.tax-forms');
Route::get('/forms-library/{state}/{entityType?}', [WebController::class, 'taxForms'])->name('web.forms-library.filter');

// Resources (uses dynamic pages + blog articles already)
// Compliance Calendar
Route::get('/compliance-calendar', [WebController::class, 'complianceCalendar'])->name('web.compliance-calendar');

// EIN Guide
Route::get('/ein-guide', [WebController::class, 'einGuide'])->name('web.ein-guide');

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

// Resources
Route::get('/resources', [WebController::class, 'resources'])->name('web.resources');
Route::get('/resources/{slug}', [WebController::class, 'resourceDetail'])->name('web.resource-detail');
