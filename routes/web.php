<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'landing']);
Route::get('/ngamal/{donation}', [HomeController::class, 'detail']);
Route::post('/ngamal/{donation}', [PaymentController::class, 'store'])->middleware('auth');
Route::get('/ngamal', [HomeController::class, 'ngamal']);
Route::get('/riwayat', [HomeController::class, 'riwayat'])->middleware('auth');
Route::get('/login', [HomeController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [HomeController::class, 'actionLogin'])->middleware('guest');
Route::get('/register', [HomeController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [HomeController::class, 'actionRegister'])->middleware('guest');
Route::delete('/logout', [HomeController::class, 'logout'])->middleware('auth');

Route::get('/payment/finish', [PaymentController::class, 'finishTransaction'])->middleware('auth');
Route::get('/payment/unfinish', [PaymentController::class, 'unfinishTransaction'])->middleware('auth');
Route::get('/payment/error', [PaymentController::class, 'errorTransaction'])->middleware('auth');
