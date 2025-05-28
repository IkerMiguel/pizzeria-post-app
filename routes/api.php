<?php

use App\Http\Controllers\api\IngredientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients');
