<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduledClassController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::get('instructor/dashboard', function () {
    return view('instructor.dashboard');
})->middleware(['auth', 'role:instructor'])->name('instructor.dashboard');

Route::resource('instructor/schedule', ScheduledClassController::class)->only(['index', 'create', 'store','destroy'])->middleware(['auth', 'role:instructor']);


Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth')->name('notifications.index');
Route::get('/notifications/{id}', [NotificationController::class, 'show'])->middleware('auth')->name('notifications.show');

/*member routes*/
Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('member/dashboard', function () {
        return view('member.dashboard');
    })->name('member.dashboard');
    Route::get('/member/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/member/bookings/upcoming', [BookingController::class, 'upcoming'])->name('booking.upcoming');
    Route::post('/member/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::delete('/member/bookings/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Test email preview route (remove in production)
Route::get('/test-email', function () {
    $user = \App\Models\User::where('role', 'member')->first();
    $scheduledClass = \App\Models\ScheduledClass::with(['classType', 'instructor'])->first();
    
    if (!$user || !$scheduledClass) {
        return 'Please create a member user and a scheduled class first.';
    }
    
    return new \App\Mail\ClassBookedMail($scheduledClass, $user);
})->middleware('auth');
