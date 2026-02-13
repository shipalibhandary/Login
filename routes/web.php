<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('roles', RoleController::class)->except(['show']);
Route::resource('users', UserController::class)->except(['show']);

    Route::get('dashboard', function () {
        
        return view('admin.dashboard.index', ['title' => 'Admin Dashboard']);
    })->name('dashboard');

    Route::get('roles/deleted', [RoleController::class, 'deleted'])
        ->name('roles.deleted');
    Route::put('roles/restore/{id}', [RoleController::class, 'restore'])
        ->name('roles.restore');
    Route::delete('roles/force-delete/{id}', [RoleController::class, 'forceDelete'])
        ->name('roles.forceDelete');
    Route::get('users/deleted', [UserController::class, 'deleted'])
    ->name('users.deleted');
    Route::put('users/restore/{id}', [UserController::class, 'restore'])
    ->name('users.restore');
    Route::delete('users/force-delete/{id}', [UserController::class, 'forceDelete'])
    ->name('users.forceDelete');

});

Route::view('/', 'auth.login')->name('login');
Route::view('/forgot-mpin', 'auth.forgot-mpin')->name('forgot.mpin');
Route::view('/set-mpin', 'auth.set-mpin')->name('set.mpin');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/forgot-mpin', [AuthController::class, 'sendOtp'])->name('forgot.mpin.submit');
Route::post('/set-mpin', [AuthController::class, 'storeMpin'])->name('mpin.store');

Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('otp.form');
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('otp.send');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/resend-otp', [OtpController::class, 'resendOtp'])->name('otp.resend');
