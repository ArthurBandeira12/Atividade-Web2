<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookControllerApi;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| Auth (Sanctum)
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Rotas públicas (somente leitura)
|--------------------------------------------------------------------------
*/
Route::get('/books', [BookControllerApi::class, 'index']);
Route::get('/books/{book}', [BookControllerApi::class, 'show']);

/*
|--------------------------------------------------------------------------
| Rotas protegidas (admin / bibliotecario)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/books', [BookControllerApi::class, 'store']);
    Route::put('/books/{book}', [BookControllerApi::class, 'update']);
    Route::delete('/books/{book}', [BookControllerApi::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
