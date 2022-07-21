<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\LoginController;
// use App\Http\Controllers\Api\GoogleTwoFactorController;
use App\Models\User;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AccountController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
    
// });

Route::middleware('auth:sanctum')->group(function () {

    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });

    Route::get('/user', [AccountController::class, 'getUser']);
    Route::get('/users', [AccountController::class, 'getUsers']);
    
    // Route::get('users', function () {
    //     logger(Auth::get());
    //     return User::get();
    // });
    // Route::get('online_users', function () {
    //     return view('online_users');
    // });
    
});

// Route::group(['prefix' => 'google2fa'], function () {
//     Route::post('/enable', [GoogleTwoFactorController::class, 'enable']);
// });

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
