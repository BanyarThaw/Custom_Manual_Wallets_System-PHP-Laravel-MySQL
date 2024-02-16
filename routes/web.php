<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\PaymentProviderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[LoginController::class,'index'])->name('login.index');
Route::get('/privacy-policy',[LoginController::class,'privacy_policy'])->name('privacy.policy');
Route::get('/login',[LoginController::class,'index']);
Route::get('/boot',[LoginController::class,'loginForm'])->name('login.form');
Route::post('/login',[LoginController::class,'login'])->name('login.login');
Route::get('/logout',[LoginController::class,'logout'])->name('login.logout')->middleware('AuthAdmin');
Route::get('/change-password',[LoginController::class,'changePasswordForm'])->name('change.password.form')->middleware('AuthAdmin');
Route::post('/change-password',[LoginController::class,'changePassword'])->name('change.password')->middleware('AuthAdmin');

Route::middleware('AuthAdmin')->group(function() {
    // payments
    Route::group(['prefix' => 'payments'], function () {
        Route::get('/list',[PaymentProviderController::class,'index'])->name('payments.index');
        Route::get('/removed/list/',[PaymentProviderController::class,'removed_list'])->name('payments.removed.list');
        Route::get('/add/{id}',[PaymentProviderController::class,'add'])->name('payments.add');
        Route::get('/create',[PaymentProviderController::class,'create'])->name('payments.create');
        Route::post('/store',[PaymentProviderController::class,'store'])->name('payments.store');
        Route::get('/edit/{id}',[PaymentProviderController::class,'edit'])->name('payments.edit');
        Route::post('/update/{id}',[PaymentProviderController::class,'update'])->name('payments.update');
        Route::get('/delete/{id}',[PaymentProviderController::class,'delete'])->name('payments.delete');
    });

    // points
    Route::get('/points',[PointController::class,'index'])->name('points.index');
    Route::get('/points/form',[PointController::class,'form'])->name('points.form');
    Route::post('/points',[PointController::class,'change'])->name('points.change');

    // deposit
    Route::group(['prefix' => 'deposits'], function () {
        Route::get('/', [DepositController::class,'index'])->name('deposits.index');
        Route::get('/approve', [DepositController::class,'approve_list'])->name('deposits.approve.list');
        Route::get('/export/form/{status}',[DepositController::class,'excel_download_form'])->name('deposits.excel.form');
        Route::post('/excel/export', [DepositController::class, 'excel_export'])->name('deposits.excel.export');
        Route::get('/reject', [DepositController::class,'reject_list'])->name('deposits.reject.list');
        Route::get('/approve/{id}', [DepositController::class,'approve'])->name('deposits.approve');
        Route::get('/reject/{id}', [DepositController::class,'reject'])->name('deposits.reject');
        Route::get('/photo/{id}',[DepositController::class,'photo'])->name('deposits.photo'); // ajax route
    });

    // withdrawal
    Route::group(['prefix' => 'withdrawals'], function () {
        Route::get('/', [WithdrawalController::class,'index'])->name('withdrawals.index');
        Route::get('/export/form/{status}',[WithdrawalController::class,'excel_download_form'])->name('withdrawals.excel.form');
        Route::post('/excel/export', [WithdrawalController::class, 'excel_export'])->name('withdrawals.excel.export');
        Route::get('/approve', [WithdrawalController::class,'approve_list'])->name('withdrawals.approve.list');
        Route::get('/reject', [WithdrawalController::class,'reject_list'])->name('withdrawals.reject.list');
        Route::get('/approve/{id}', [WithdrawalController::class,'approve'])->name('withdrawals.approve');
        Route::get('/reject/{id}', [WithdrawalController::class,'reject'])->name('withdrawals.reject');
    });

    // contact us
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/',[ContactController::class,'index'])->name('contact.index');
        Route::get('/change',[ContactController::class,'change'])->name('contact.change');
        Route::put('/change',[ContactController::class,'update'])->name('contact.update');
    });
});
