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
});
