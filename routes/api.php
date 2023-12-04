<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('produks', [\App\Http\Controllers\ProdukController::class, 'index']);
Route::post('produks', [\App\Http\Controllers\ProdukController::class, 'create']);
Route::delete('produks/{id}', [\App\Http\Controllers\ProdukController::class, 'destroy']);
Route::put('produks/{id}', [\App\Http\Controllers\ProdukController::class, 'update']);


Route::get('status', [\App\Http\Controllers\StatusController::class, 'show']);
Route::post('status', [\App\Http\Controllers\StatusController::class, 'add']);
Route::delete('status/{id}', [\App\Http\Controllers\StatusController::class, 'delete']);

Route::get('kategoris', [\App\Http\Controllers\KategoriController::class, 'show']);
Route::post('kategoris', [\App\Http\Controllers\KategoriController::class, 'add']);
Route::delete('kategoris/{id}', [\App\Http\Controllers\KategoriController::class, 'delete']);

Route::get('update-produk', [\App\Http\Controllers\CurlController::class, 'index']);

Route::get('test', [\App\Http\Controllers\TestingController::class, 'index']);
