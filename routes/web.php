<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\DutyScheduleController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AttendanceTrackerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (already protected)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // You can keep these blank view routes for now, or convert to controller later
    // Route::get('/nurse-staff', fn () => view('nurse-staff.index'))->name('nurse-staff.index');
    // Route::get('/duty-scheduling', fn () => view('duty-scheduling.index'))->name('duty-scheduling.index');
    // Route::get('/leave-request', fn () => view('leave-request.index'))->name('leave-request.index');
    // Route::get('/attendance-tracker', fn () => view('attendance-tracker.index'))->name('attendance-tracker.index');
    // Route::get('/reports', fn () => view('reports.index'))->name('reports.index');
    Route::get('/about-us', fn () => view('about'))->name('about');
    
    // Nurse
    Route::get('/nurses', [NurseController::class, 'index'])->name('nurses.index');
    Route::resource('nurses', NurseController::class);

    // Duty Scheduling
    Route::get('/duty-scheduling', [DutyScheduleController::class, 'index'])->name('duty-scheduling.index');
    Route::post('/duty-scheduling', [DutyScheduleController::class, 'store'])->name('duty.store');
    Route::delete('/duty-scheduling/{dutySchedule}', [DutyScheduleController::class, 'destroy'])->name('duty.destroy');

    // Leave Request
    Route::get('/leave-request', [LeaveRequestController::class, 'index'])->name('leave-request.index');
    Route::post('/leave-request', [LeaveRequestController::class, 'store'])->name('leave-request.store');

    // Attendance Tracker
    Route::get('/attendance-tracker', [AttendanceTrackerController::class, 'index'])->name('attendance-tracker.index');

    // Rports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/notes', [DashboardController::class, 'storeNote'])->name('notes.store');
});


require __DIR__.'/auth.php';
