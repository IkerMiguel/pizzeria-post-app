<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BrancheController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\Raw_materialController;
use App\Http\Controllers\api\Pizza_raw_materialController;
use App\Http\Controllers\api\PurchaseController;
use App\Http\Controllers\api\Order_extra_ingredientController;
use App\Http\Controllers\api\PizzaController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\Extra_ingredientController;


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
Route::get('/order-extra-ingredients', [Order_extra_ingredientController::class, 'index']);
Route::post('/order-extra-ingredients', [Order_extra_ingredientController::class, 'store']);
Route::get('/order-extra-ingredients/{id}', [Order_extra_ingredientController::class, 'show']);
Route::put('/order-extra-ingredients/{id}', [Order_extra_ingredientController::class, 'update']);
Route::delete('/order-extra-ingredients/{id}', [Order_extra_ingredientController::class, 'destroy']);

//Branch
Route::get('/branches', [BrancheController::class, 'index']);
Route::post('/branches', [BrancheController::class, 'store']);
Route::get('/branches/{id}', [BrancheController::class, 'show']);
Route::put('/branches/{id}', [BrancheController::class, 'update']);
Route::delete('/branches/{id}', [BrancheController::class, 'destroy']);

//Supplier
Route::get('/suppliers', [SupplierController::class, 'index']);
Route::post('/suppliers', [SupplierController::class, 'store']);
Route::get('/suppliers/{id}', [SupplierController::class, 'show']);
Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);

//Raw Material
Route::get('/raw-materials', [Raw_materialController::class, 'index']);
Route::post('/raw-materials', [Raw_materialController::class, 'store']);
Route::get('/raw-materials/{id}', [Raw_materialController::class, 'show']);
Route::put('/raw-materials/{id}', [Raw_materialController::class, 'update']);
Route::delete('/raw-materials/{id}', [Raw_materialController::class, 'destroy']);

//Pizza Raw Material
Route::get('/pizza-raw-materials', [Pizza_raw_materialController::class, 'index']);
Route::post('/pizza-raw-materials', [Pizza_raw_materialController::class, 'store']);
Route::get('/pizza-raw-materials/{id}', [Pizza_raw_materialController::class, 'show']);
Route::put('/pizza-raw-materials/{id}', [Pizza_raw_materialController::class, 'update']);
Route::delete('/pizza-raw-materials/{id}', [Pizza_raw_materialController::class, 'destroy']);

//Pizza
Route::get('/pizzas', [PizzaController::class, 'index']);

//order
Route::get('/orders', [OrderController::class, 'index']);

//Extra Ingredient
Route::get('/extra-ingredients', [Extra_ingredientController::class, 'index']);
