<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\XmlGoodsController;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\GoodsController;
use \App\Http\Controllers\ListGoodsController;
use \App\Http\Controllers\SignValidationController;

/**
 * Load start page
 */
Route::get('/', function () { return view('welcome'); })->name('home');

/**
 * Private admin part of site
 */
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get("/sign/{id}", [SignValidationController::class, 'index'] )->name('sign_valid');
    Route::get("/?page={pag}", [ListGoodsController::class, 'index'] );
    Route::get("/view/{id}", [GoodsController::class, 'index'] )->name('good_card');
    Route::get('/logout', [AuthController::class, 'authLogout'] )->name('authLogout');
    Route::get("/", [ListGoodsController::class, 'index'] )->name('admin_panel');
});

/**
 * Save data to server
 */
Route::prefix('/server')->group(function() {
    Route::post('/xml', [XmlGoodsController::class, 'saveDB'] );
    Route::post('/auth', [AuthController::class, 'auth'] );
    Route::post('/auth-check', [AuthController::class, 'authCheck'] );
});





