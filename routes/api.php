<?php

use App\Http\Controllers\testController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('user', [testController::class, 'userInfo']);
Route::get('user', [testController::class, 'getUserInfo']);

Route::post('message', [testController::class, 'userMessage']);
Route::get('message', [testController::class, 'getUserMessage']);
Route::get('test', [testController::class, 'test']);
