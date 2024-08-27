<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'data'], function () {
    Route::get('acc-sub', [AccountsController::class, 'index']);
    Route::get('get-provinces', [AccountsController::class, 'get_provinces']);
    Route::get('get-regencies/{id_province}', [AccountsController::class, 'get_regencies']);
    Route::get('get-districts/{id_id_regency}', [AccountsController::class, 'get_districts']);
    Route::get('get-villages/{id_district}', [AccountsController::class, 'get_villages']);
});
