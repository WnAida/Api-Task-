<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
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
Route::prefix('customer')->group(function () {
    Route::post('/', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/{customer}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customerlist', [CustomerController::class, 'customerlist']);
    Route::get('/showdetail/{customer}', [CustomerController::class, 'showdetail']);
    Route::delete('/delete/{customer}', [CustomerController::class, 'delete']);
});