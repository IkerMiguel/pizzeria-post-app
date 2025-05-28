<?php

use App\Http\Controllers\api\IngredientController;
use App\Http\Controllers\api\Pizza_ingredientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients');
Route::get('/ingredients/{ingredient}', [IngredientController::class, 'show'])->name('ingredients.show');
Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');

Route::post('/pizza_ingredients', [Pizza_ingredientController::class, 'store'])->name('pizza_ingredient.store');
Route::get('/pizza_ingredients', [Pizza_ingredientController::class, 'index'])->name('pizza_ingredients');
