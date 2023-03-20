<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\xmlGoodsController;
use \App\Http\Controllers\AuthController;

Route::get('/', function () { return view('welcome'); })->name('home');

Route::post('/server/xml', [xmlGoodsController::class, 'saveDB'] );
Route::post('/server/auth', [AuthController::class, 'auth'] );
Route::post('/server/auth-check', [AuthController::class, 'authCheck'] );
Route::get('/server/logout', [AuthController::class, 'authLogout'] )->name('authLogout');

Route::get('/admin', function() {
    return view('admin.index');
})->middleware('auth')->name('admin');



//temp decision
Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);



