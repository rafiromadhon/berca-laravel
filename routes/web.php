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

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\UserController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [LoginController::class, 'index']);
Route::post('auth', [LoginController::class, 'authenticate'])->name('login.auth');
Route::get('logout', [LoginController::class, 'logout']);

Route::middleware(['login'])->group(function () {
    Route::get('/', function () {
        return view('pages.home');
    });

    Route::group(['prefix' => 'menus'], function () {
        Route::get('acc-sub', function () {
            return view('pages.acc-sub');
        });
    });

    Route::group(['prefix' => 'menus'], function () {
        Route::get('unlock-user', function () {
            return view('pages.unlock-user');
        });
    });

    Route::group(['prefix' => 'data'], function () {
        Route::get('acc-sub', [AccountsController::class, 'index']);
        Route::get('get-provinces', [AccountsController::class, 'get_provinces']);
        Route::get('get-regencies/{id_province}', [AccountsController::class, 'get_regencies']);
        Route::get('get-districts/{id_id_regency}', [AccountsController::class, 'get_districts']);
        Route::get('get-villages/{id_district}', [AccountsController::class, 'get_villages']);
        Route::get('get-occupations', [AccountsController::class, 'get_occupations']);
        Route::post('insert-acc-sub', [AccountsController::class, 'insert_acc_sub']);
        Route::get('approve-acc/{id}', [AccountsController::class, 'approve_acc']);
        Route::get('sessions', [AccountsController::class, 'sessions']);
        Route::get('unlock-user/{username}', [UserController::class, 'unlock_user']);
    });
});
