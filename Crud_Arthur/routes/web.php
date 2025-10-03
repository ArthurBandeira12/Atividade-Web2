<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionariosController;

Route::resource('funcionarios', FuncionariosController::class);


Route::get('/', function () {
    return view('welcome');
});
