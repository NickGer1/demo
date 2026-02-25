<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\Admin\ClaimAdminController;

Route::view('/', 'home')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('requests', [ClaimController::class, 'index'])->name('requests.index');
    Route::get('/claims/create', [ClaimController::class, 'create'])->name('claims.create');
    Route::post('/claims', [ClaimController::class, 'store'])->name('claims.store');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
   Route::get('/requests', [ClaimController::class, 'index'])->name('requests.index');
   Route::patch('/requests/{claim}/status', [ClaimAdminController::class, 'updateStatus'])->name('requests.status');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

//Route::get('/', function () {
//    return view('welcome');
//});
