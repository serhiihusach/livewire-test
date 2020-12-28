<?php

use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;

Route::get('/', ['middleware' => 'guest', function () {
    return view('auth.login');
}])->name('home');

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::view('register', 'auth.register')->name('register');
});

Route::get('user/{user}', function ($user) {
    return response()->json($user);
})->name('users.show');

Route::get('user/{user}/edit', function (User $user) {
    return response()->json($user);
})->name('users.edit');

Route::delete('user/{user}', function ($user) {
    return response()->json($user);
})->name('users.delete');

Route::view('password/reset', 'auth.passwords.email')->name('password.request');
Route::get('password/reset/{token}', 'Auth\PasswordResetController')->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::view('email/verify', 'auth.verify')->middleware('throttle:6,1')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\EmailVerificationController')->middleware('signed')->name('verification.verify');

    Route::post('logout', 'Auth\LogoutController')->name('logout');

    Route::view('password/confirm', 'auth.passwords.confirm')->name('password.confirm');
});
