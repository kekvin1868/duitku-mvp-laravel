<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('transactions', TransactionController::class);

// Payment
Route::get('/pay/{id}', [TransactionController::class, 'showPaymentMenu'])->name('transactions.pay');
