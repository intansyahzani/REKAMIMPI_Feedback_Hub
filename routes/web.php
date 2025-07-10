<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\AdminAuth;

// 🌐 Welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ✍️ Feedback routes (Public)
Route::get('/rate-us', [FeedbackController::class, 'showForm'])->name('feedback.form');
Route::post('/feedback/submit', [FeedbackController::class, 'submit'])->name('feedback.submit');
Route::get('/review-history', [FeedbackController::class, 'reviewHistory'])->name('feedback.history');

// 🔐 Admin Login (Public)
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

// 🔒 Admin-only routes (protected by AdminAuth middleware)
Route::middleware([AdminAuth::class])->group(function () {

    // 📊 Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // 📈 Analytics
    Route::get('/admin/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics');

    // 💬 Feedback Listing (Admin)
    Route::get('/admin/feedbacks', [FeedbackController::class, 'index'])->name('admin.feedbacks');

    // 📁 Report Exporting
    Route::get('/admin/reports', [ReportController::class, 'reportsView'])->name('admin.reports');
    Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reports/export', [ReportController::class, 'exportCsv'])->name('admin.reports.export');
});


    // 📮 Respond/Delete Feedback
    Route::post('/feedback/{id}/response', [FeedbackController::class, 'respond'])->name('feedback.respond');
    Route::delete('/feedback/{id}', [FeedbackController::class, 'delete'])->name('feedback.delete');

    // 📦 Item Management (NEW)
    Route::prefix('/admin/items')->name('admin.items.')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('index');          // List all items
        Route::get('/create', [ItemController::class, 'create'])->name('create');  // Show add form
        Route::post('/', [ItemController::class, 'store'])->name('store');         // Store new item
        Route::get('/{item}/edit', [ItemController::class, 'edit'])->name('edit'); // Show edit form
        Route::put('/{item}', [ItemController::class, 'update'])->name('update');  // Update item
        Route::delete('/{item}', [ItemController::class, 'destroy'])->name('destroy'); // Delete item
    });

    // 🚪 Admin Logout
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
