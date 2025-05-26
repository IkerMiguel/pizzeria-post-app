<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pizza_raw_material;
use Illuminate\Support\Facades\DB;

class Pizaa_raw_materialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $items = DB::table('pizza_raw_material')
            ->join('pizzas', 'pizza_raw_material.pizza_id', '=', 'pizzas.id')
            ->join('raw_materials', 'pizza_raw_material.raw_material_id', '=', 'raw_materials.id')
            ->select('pizza_raw_material.*', 'pizzas.name as pizza_name', 'raw_materials.name as material_name')
            ->get();

        return json_encode(['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pizza_id' => ['required', 'numeric'],
            'raw_material_id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $item = new PizzaRawMaterial();
        $item->pizza_id = $request->pizza_id;
        $item->raw_material_id = $request->raw_material_id;
        $item->quantity = $request->quantity;
        $item->save();

        return json_encode(['item' => $item]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = PizzaRawMaterial::find($id);
        if (is_null($item)) {
            return abort(404);
        }

        return json_encode(['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'pizza_id' => ['required', 'numeric'],
            'raw_material_id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $item = PizzaRawMaterial::find($id);
        if (is_null($item)) {
            return abort(404);
        }

        $item->pizza_id = $request->pizza_id;
        $item->raw_material_id = $request->raw_material_id;
        $item->quantity = $request->quantity;
        $item->save();

        return json_encode(['item' => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
