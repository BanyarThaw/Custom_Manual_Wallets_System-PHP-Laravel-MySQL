<?php

use App\Http\Controllers\api\v1\ContactController;
use App\Http\Controllers\api\v1\DepositController;
use App\Http\Controllers\api\v1\PaymentProviderController;
use App\Http\Controllers\api\v1\PointController;
use App\Http\Controllers\api\v1\WithdrawalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('TokenAuth')->group(function() {
    Route::get('/contact',[ContactController::class,'contact_information']);
    Route::get('/point',[PointController::class,'point']);
    Route::get('/payment-providers',[PaymentProviderController::class,'payment_provider_list']);
    Route::get('/payment-providers/{id}',[PaymentProviderController::class,'payment_provider']);
    Route::post('/deposit',[DepositController::class,'send_deposit']);
    Route::post('/deposit/history',[DepositController::class,'history']);
    Route::post('/withdrawal',[WithdrawalController::class,'send_withdrawal']);
    Route::post('/withdrawal/history',[WithdrawalController::class,'history']);
});
