<?php

use App\Http\Controllers\CateigorieController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\stockesController;
use App\Models\Cateigorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\productController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[AuthController::class , 'register']);
Route::post('/login',[AuthController::class , 'login']);
Route::post('/product',[productController::class ,'product']);
Route::post('/stock',[stockesController::class ,'stock']);
Route::get('/liste_produits/{id}',[productController::class ,'liste_produits']);
Route::post('/search',[productController::class ,'searchProduit']);
Route::get('/produits_populaires/{id}',[productController::class ,'produits_populaires']);
Route::get('/produits_rayon/{id}',[productController::class ,'produits_rayon']);


Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::post('/rayon', [RayonController::class, 'rayon']);
    Route::post('/Cateigorie', [CateigorieController::class, 'Cateigorie']);

});

