<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\BrancheController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\Raw_materialController;
use App\Http\Controllers\api\Pizza_sizeController;
use App\Http\Controllers\api\Pizza_raw_materialController;
use App\Http\Controllers\api\PurchaseController;
use App\Http\Controllers\api\Order_extra_ingredientController;
use App\Http\Controllers\api\PizzaController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\IngredientController;
use App\Http\Controllers\api\Pizza_ingredientController;
use App\Http\Controllers\api\Extra_ingredientController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients');
Route::get('/ingredients/{ingredient}', [IngredientController::class, 'show'])->name('ingredients.show');
Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');

// Pizza Ingredient
Route::post('/pizza_ingredients', [Pizza_ingredientController::class, 'store'])->name('pizza_ingredients.store');
Route::get('/pizza_ingredients', [Pizza_ingredientController::class, 'index'])->name('pizza_ingredients');
Route::get('/pizza_ingredients/{pizza_ingredient}', [Pizza_ingredientController::class, 'show'])->name('pizza_ingredients.show');
Route::put('/pizza_ingredients/{pizza_ingredient}', [Pizza_ingredientController::class, 'update'])->name('pizza_ingredients.update');
Route::delete('/pizza_ingredients/{pizza_ingredient}', [Pizza_ingredientController::class, 'destroy'])->name('pizza_ingredients.destroy');

Route::post('/extra_ingredients', [Extra_ingredientController::class, 'store'])->name('extra_ingredients.store');
Route::get('/extra_ingredients', [Extra_ingredientController::class, 'index'])->name('extra_ingredients');
Route::get('/extra_ingredients/{extra_ingredient}', [Extra_ingredientController::class, 'show'])->name('extra_ingredients.show');
Route::put('/extra_ingredients/{extra_ingredient}', [Extra_ingredientController::class, 'update'])->name('extra_ingredients.update');
Route::delete('/extra_ingredients/{extra_ingredient}', [Extra_ingredientController::class, 'destroy'])->name('extra_ingredients.destroy');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}', [Extra_ingredientController::class, 'destroy'])->name('orders.destroy');

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

//client
Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients', [ClientController::class, 'store']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::put('/clients/{id}', [ClientController::class, 'update']);
Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

//user
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

//Employee
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

//Pizza
Route::get('/pizzas', [PizzaController::class, 'index']);
Route::post('/pizzas', [PizzaController::class, 'store']);
Route::get('/pizzas/{id}', [PizzaController::class, 'show']);
Route::put('/pizzas/{id}', [PizzaController::class, 'update']);
Route::delete('/pizzas/{id}', [PizzaController::class, 'destroy']);


// Pizza Size
Route::get('/pizza-sizes', [Pizza_sizeController::class, 'index']);
Route::post('/pizza-sizes', [Pizza_sizeController::class, 'store']);
Route::get('/pizza-sizes/{id}', [Pizza_sizeController::class, 'show']);
Route::put('/pizza-sizes/{id}', [Pizza_sizeController::class, 'update']);
Route::delete('/pizza-sizes/{id}', [Pizza_sizeController::class, 'destroy']);


