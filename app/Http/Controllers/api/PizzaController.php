<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pizza;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizzas = DB::table('pizzas')->get();
        return json_encode(['pizzas' => $pizzas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                $request->validate([
            'name' => ['required', 'max:255'],
            'pizza_size_id' => ['required', 'exists:pizza_sizes,id'],
            'ingredient_ids' => ['array'],
            'ingredient_ids.*' => ['exists:ingredients,id'],
            'raw_material_ids' => ['array'],
            'raw_material_ids.*' => ['exists:raw_materials,id'],
        ]);

        $pizza = new Pizza();
        $pizza->name = $request->name;
        $pizza->pizza_size_id = $request->pizza_size_id;
        $pizza->save();

        if ($request->has('ingredient_ids')) {
            $pizza->ingredients()->sync($request->ingredient_ids);
        }

        if ($request->has('raw_material_ids')) {
            $pizza->raw_materials()->sync($request->raw_material_ids);
        }

        return json_encode(['pizza' => $pizza->load(['pizza_size', 'ingredients', 'raw_materials'])]);
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
