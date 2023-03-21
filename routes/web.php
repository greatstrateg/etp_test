<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\XmlGoodsController;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\GoodsController;
use \App\Http\Controllers\ListGoodsController;

Route::get('/', function () { return view('welcome'); })->name('home');

Route::post('/server/xml', [XmlGoodsController::class, 'saveDB'] );
Route::post('/server/auth', [AuthController::class, 'auth'] );
Route::post('/server/auth-check', [AuthController::class, 'authCheck'] );
Route::get('/server/logout', [AuthController::class, 'authLogout'] )->name('authLogout');

Route::prefix('/admin')->middleware('auth')->group(function() {
    Route::get("/{pag?}", [ListGoodsController::class, 'index'] )->name('admin_panel');
    Route::get("/view/{id}", [GoodsController::class, 'index'] )->name('good_card');
});




//temp decision
Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);



