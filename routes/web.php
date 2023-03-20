<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\xmlGoodsController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/server', [xmlGoodsController::class, 'saveDB'] );

//temp decision
Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);



