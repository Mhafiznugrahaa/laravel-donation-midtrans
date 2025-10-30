<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/payments', [PaymentController::class, 'store']);
Route::post('/webhook/midtrans', [PaymentController::class, 'webhook']);
