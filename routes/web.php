<?php

use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HomepageSectionController;
use App\Http\Controllers\Admin\HomepageServiceItemController;
use App\Http\Controllers\Admin\HomepageTabController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ServiceRequestController as AdminServiceRequestController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TermsPageController;
use App\Http\Controllers\Admin\TrustedBrandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\ContactMessageController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ServiceController;
use App\Http\Controllers\Website\ServiceRequestController;
use App\Http\Controllers\Website\TermsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/terms', TermsController::class)->name('terms.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::post('/contact-messages', [ContactMessageController::class, 'store'])->name('contact-messages.store');
Route::post('/service-requests', [ServiceRequestController::class, 'store'])->name('service-requests.store');

Route::get('/dashboard', function () {
    if (auth()->user()?->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');
    Route::resource('service-categories', ServiceCategoryController::class)->except('show');
    Route::resource('services', AdminServiceController::class)->except('show');
    Route::resource('homepage-sections', HomepageSectionController::class)->except('show');
    Route::resource('homepage-service-items', HomepageServiceItemController::class)->except('show');
    Route::resource('homepage-tabs', HomepageTabController::class)->except('show');
    Route::resource('trusted-brands', TrustedBrandController::class)->except('show');
    Route::get('terms', [TermsPageController::class, 'edit'])->name('terms.edit');
    Route::put('terms', [TermsPageController::class, 'update'])->name('terms.update');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('contact-messages', AdminContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::resource('service-requests', AdminServiceRequestController::class)->only(['index', 'show', 'destroy']);
});

require __DIR__ . '/auth.php';
