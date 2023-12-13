<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//--------------------------------Auth Modeule------------------------------
Route::controller(AuthController::class)->group(function(){
    Route::post('login','login')->name('login');
    Route::post('logout','logout')->middleware('auth:sanctum')->name('logout');
});

Route::middleware('auth:sanctum')->controller(InvoiceController::class)->prefix('invoices')->group(function(){
    Route::get('/{id}','index')->name('index');
    Route::post('/','create')->name('create');
});
