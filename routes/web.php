<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::get('dashboard', function () {
        
        return view('admin.dashboard.index', ['title' => 'Admin Dashboard']);
    })->name('dashboard');
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
