<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\CateigorieController;
use App\Http\Controllers\clientController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);




Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {

    Route::post('/Cateigorie', [CateigorieController::class, 'Cateigorie']);

    Route::post('/rayon', [RayonController::class, 'rayon']);
    Route::Delete('/deleteRayon/{id}', [RayonController::class, 'deleteRayon']);
    Route::post('/rayon/{id}', [RayonController::class, 'updateRayon']);
    Route::get('/searchRayon/{search}', [RayonController::class, 'searchRayon']);
    Route::get('/showRayon', [RayonController::class, 'showRayon']);

    Route::post('/product', [productController::class, 'product']);
    Route::Delete('/deleteproduit/{id}', [productController::class, 'deleteproduit']);
    Route::post('/updateproduct/{id}', [productController::class, 'updateproduct']);

    Route::post('/stock', [stockesController::class, 'stock']);

    Route::Delete('/deleteCateigorie/{id}', [CateigorieController::class, 'deleteCateigorie']);
    Route::post('/updateCateigorie/{id}', [CateigorieController::class, 'updateCateigorie']);
    Route::get('/searchCateigorie/{search}', [CateigorieController::class, 'searchCateigorie']);
    Route::get('/showCateigorie', [CateigorieController::class, 'showCateigorie']);
});


Route::group(['middleware' => ['auth:sanctum', 'client']], function () {

    Route::get('/liste_produits/{id}', [productController::class, 'liste_produits']);
    Route::post('/search', [productController::class, 'searchProduit']);
    Route::get('/produits_populaires/{id}', [productController::class, 'produits_populaires']);
    Route::get('/produits_promotion/{id}', [productController::class, 'produits_promotion']);
    Route::post('/Achter', [clientController::class, 'Achter']);

});

Route::get('/notificationStock', [adminController::class, 'notificationStock']);
