<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BranchController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\RawMaterialController;
use App\Http\Controllers\api\PizzaRawMaterialController;
use App\Http\Controllers\api\PurchaseController;
use App\Http\Controllers\api\OrderExtraIngredientController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Purchase 
Route::get('/purchases', [PurchaseController::class, 'index']);
Route::post('/purchases', [PurchaseController::class, 'store']);
Route::get('/purchases/{id}', [PurchaseController::class, 'show']);
Route::put('/purchases/{id}', [PurchaseController::class, 'update']);
Route::delete('/purchases/{id}', [PurchaseController::class, 'destroy']);

//order extra ingredient
Route::get('/order-extra-ingredients', [OrderExtraIngredientController::class, 'index']);
Route::post('/order-extra-ingredients', [OrderExtraIngredientController::class, 'store']);
Route::get('/order-extra-ingredients/{id}', [OrderExtraIngredientController::class, 'show']);
Route::put('/order-extra-ingredients/{id}', [OrderExtraIngredientController::class, 'update']);
Route::delete('/order-extra-ingredients/{id}', [OrderExtraIngredientController::class, 'destroy']);

//Branch
Route::get('/branches', [BranchController::class, 'index']);
Route::post('/branches', [BranchController::class, 'store']);
Route::get('/branches/{id}', [BranchController::class, 'show']);
Route::put('/branches/{id}', [BranchController::class, 'update']);
Route::delete('/branches/{id}', [BranchController::class, 'destroy']);

//Supplier
Route::get('/suppliers', [SupplierController::class, 'index']);
Route::post('/suppliers', [SupplierController::class, 'store']);
Route::get('/suppliers/{id}', [SupplierController::class, 'show']);
Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);

//Raw Material
Route::get('/raw-materials', [RawMaterialController::class, 'index']);
Route::post('/raw-materials', [RawMaterialController::class, 'store']);
Route::get('/raw-materials/{id}', [RawMaterialController::class, 'show']);
Route::put('/raw-materials/{id}', [RawMaterialController::class, 'update']);
Route::delete('/raw-materials/{id}', [RawMaterialController::class, 'destroy']);

//Pizza Raw Material
Route::get('/pizza-raw-materials', [PizzaRawMaterialController::class, 'index']);
Route::post('/pizza-raw-materials', [PizzaRawMaterialController::class, 'store']);
Route::get('/pizza-raw-materials/{id}', [PizzaRawMaterialController::class, 'show']);
Route::put('/pizza-raw-materials/{id}', [PizzaRawMaterialController::class, 'update']);
Route::delete('/pizza-raw-materials/{id}', [PizzaRawMaterialController::class, 'destroy']);
