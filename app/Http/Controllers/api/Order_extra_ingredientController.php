<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order_extra_ingredient;
use Illuminate\Support\Facades\DB;

class Order_extra_ingredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $items = DB::table('order_extra_ingredient')
            ->join('orders', 'order_extra_ingredient.order_id', '=', 'orders.id')
            ->join('extra_ingredients', 'order_extra_ingredient.extra_ingredient_id', '=', 'extra_ingredients.id')
            ->select('order_extra_ingredient.*', 'orders.id as order_id', 'extra_ingredients.name as ingredient_name')
            ->get();

        return json_encode(['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => ['required', 'numeric', 'min:1'],
            'extra_ingredient_id' => ['required', 'numeric', 'min:1'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $item = new OrderExtraIngredient();
        $item->order_id = $request->order_id;
        $item->extra_ingredient_id = $request->extra_ingredient_id;
        $item->quantity = $request->quantity;
        $item->save();

        return json_encode(['item' => $item]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $item = OrderExtraIngredient::find($id);
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
            'order_id' => ['required', 'numeric', 'min:1'],
            'extra_ingredient_id' => ['required', 'numeric', 'min:1'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $item = OrderExtraIngredient::find($id);
        if (is_null($item)) {
            return abort(404);
        }

        $item->order_id = $request->order_id;
        $item->extra_ingredient_id = $request->extra_ingredient_id;
        $item->quantity = $request->quantity;
        $item->save();

        return json_encode(['item' => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = OrderExtraIngredient::find($id);
        if (is_null($item)) {
            return abort(404);
        }

        $item->delete();

        $items = DB::table('order_extra_ingredient')
            ->join('orders', 'order_extra_ingredient.order_id', '=', 'orders.id')
            ->join('extra_ingredients', 'order_extra_ingredient.extra_ingredient_id', '=', 'extra_ingredients.id')
            ->select('order_extra_ingredient.*', 'orders.id as order_id', 'extra_ingredients.name as ingredient_name')
            ->get();

        return json_encode(['items' => $items, 'success' => true]);
    }
}
