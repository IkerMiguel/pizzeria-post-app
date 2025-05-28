<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pizza_ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Pizza_ingredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizza_ingredients = DB::table('pizza_ingredient')
            ->join('pizzas','pizza_ingredient.pizza_id', '=', 'pizzas.id')
            ->join('ingredients', 'pizza_ingredient.ingredient_id', '=', 'ingredients.id')
            ->select('pizza_ingredient.*', 'pizzas.name as pizza_name', 'ingredients.name as ingredient_name')
            ->orderBy('pizza_ingredient.pizza_id')
            ->get();
        return json_encode(['pizza_ingredients'=>$pizza_ingredients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
