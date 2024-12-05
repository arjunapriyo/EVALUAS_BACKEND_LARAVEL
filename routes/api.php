<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;

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

Route::post('/user', [UserController::class, 'create']);
Route::get('/user', [UserController::class, 'index']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::get('/user/{id}', 'App\Http\Controllers\UserController@getUserById');
Route::delete('/user/{id}', 'App\Http\Controllers\UserController@delete');