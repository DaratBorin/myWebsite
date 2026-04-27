<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;

// ── PUBLIC ────────────────────────────────────────────────────────────────────
Route::get('/',           [HomeController::class, 'index'])->name('home');
Route::get('/menu',       [MenuController::class, 'index'])->name('menu');
Route::get('/menu/{category}', [MenuController::class, 'category'])->name('menu.category');
Route::get('/about',      [AboutController::class, 'index'])->name('about');
Route::get('/contact',    [ContactController::class, 'index'])->name('contact');
Route::post('/contact',   [ContactController::class, 'send'])->name('contact.send');
Route::post('/feedback', [ContactController::class, 'submitFeedback'])->name('feedback.store');
Route::get('/reservations',             [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations',            [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/confirmation/{id}', [ReservationController::class, 'confirmation'])->name('reservations.confirmation');

// ── ORDER ─────────────────────────────────────────────────────────────────────
Route::get('/cart',             [OrderController::class, 'cart'])->name('order.cart');
Route::post('/cart/add',        [OrderController::class, 'addToCart'])->name('order.add');
Route::post('/cart/update',     [OrderController::class, 'updateCart'])->name('order.update');
Route::post('/cart/remove',     [OrderController::class, 'removeFromCart'])->name('order.remove');
Route::get('/checkout',         [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/checkout',        [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/confirmation/{order}', [OrderController::class, 'confirmation'])->name('order.confirmation');

// ── PAYMENT ───────────────────────────────────────────────────────────────────
Route::get('/payment/{order}',          [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::post('/payment/{order}/stripe',  [PaymentController::class, 'processStripe'])->name('payment.stripe');
Route::get('/payment/{order}/confirm',  [PaymentController::class, 'confirmStripe'])->name('payment.confirm');
Route::post('/payment/{order}/cash',    [PaymentController::class, 'processCash'])->name('payment.cash');
Route::post('/payment/{order}/qr-confirm', [PaymentController::class, 'confirmQR'])->name('payment.qr.confirm');

// ── DASHBOARD (must be before auth.php) ──────────────────────────────────────
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ── AUTH (Breeze) ─────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ── ADMIN ─────────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('menu-items', MenuItemController::class)->parameters(['menu-items' => 'menuItem']);
    Route::patch('menu-items/{menuItem}/toggle', [MenuItemController::class, 'toggleAvailability'])->name('menu-items.toggle');

    Route::resource('reservations', AdminReservationController::class)->except(['create', 'store']);
    Route::patch('reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])->name('reservations.status');

    Route::get('orders',               [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}',       [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');

    Route::get('payments',             [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::patch('payments/{payment}/mark-paid', [AdminPaymentController::class, 'markPaid'])->name('payments.markPaid');

    // Feedback
    Route::get('feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedback.index');
    Route::patch('feedback/{feedback}/status', [App\Http\Controllers\Admin\FeedbackController::class, 'updateStatus'])->name('feedback.status');
    Route::delete('feedback/{feedback}', [App\Http\Controllers\Admin\FeedbackController::class, 'destroy'])->name('feedback.destroy');

    // Enquiries
    Route::get('enquiries', [App\Http\Controllers\Admin\EnquiryController::class, 'index'])->name('enquiries.index');
    Route::patch('enquiries/{enquiry}/status', [App\Http\Controllers\Admin\EnquiryController::class, 'updateStatus'])->name('enquiries.status');
    Route::delete('enquiries/{enquiry}', [App\Http\Controllers\Admin\EnquiryController::class, 'destroy'])->name('enquiries.destroy');
});