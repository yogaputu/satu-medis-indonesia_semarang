<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute yang dilindungi menggunakan JWT
// Route::middleware(['auth:api'])->get('/items', [ItemController::class, 'index']);
// Route::middleware(['auth:api'])->get('/items/{item}', [ItemController::class, 'show']);
// Route::middleware(['auth:api'])->post('/items', [ItemController::class, 'store']);
// Route::middleware(['auth:api'])->put('/items/{item}', [ItemController::class, 'update']);
// Route::middleware(['auth:api'])->delete('/items/{item}', [ItemController::class, 'destroy']);

Route::group(['middleware' =>'api','prefix'=>'auth'],function($route){
    Route::post('/login', [AuthController::class, 'login']);
});
// Route::post('/login', [AuthController::class, 'login']);

// Route::group(['middleware' => 'auth.jwt'], function () {
//     Route::get('/items', [ItemController::class, 'index']);
//     Route::post('/items', [ItemController::class, 'store']);
//     Route::get('/items/{id}', [ItemController::class, 'show']);
//     Route::put('/items/{id}', [ItemController::class, 'update']);
//     Route::delete('/items/{id}', [ItemController::class, 'destroy']);
// });

// Route::middleware(['auth.jwt'])->group(function () {
//     Route::get('/items', [ItemController::class, 'index']);
// });