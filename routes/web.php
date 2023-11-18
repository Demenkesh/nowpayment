<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Laravel 8 & 9
Route::get('merchantcoin', [App\Http\Controllers\PaymentController::class, 'merchantcoin']);
Route::get('createpayement', [App\Http\Controllers\PaymentController::class, 'createpayement']);
Route::get('createaninvoice', [App\Http\Controllers\PaymentController::class, 'createaninvoice']);
Route::get('getinvoicebyinvoiceIdandpurchaseId', [App\Http\Controllers\PaymentController::class, 'getinvoicebyinvoiceIdandpurchaseId']);
Route::get('getpaymentstatus', [App\Http\Controllers\PaymentController::class, 'getpaymentstatus']);
Route::get('minamount', [App\Http\Controllers\PaymentController::class, 'minamount']);
