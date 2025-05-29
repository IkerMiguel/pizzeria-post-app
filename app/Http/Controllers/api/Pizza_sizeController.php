<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pizza_size;
use Illuminate\Support\Facades\DB;

class Pizza_sizeController extends Controller
{
    public function index()
    {
        $items = DB::table('pizza_size')
            ->join('pizzas', 'pizza_size.pizza_id', '=', 'pizzas.id')
            ->select('pizza_size.*', 'pizzas.name as pizza_name')
            ->get();

        return response()->json(['items' => $items]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pizza_id' => ['required', 'numeric'],
            'size' => ['required', 'in:pequeña,mediana,grande'],
            'price' => ['required', 'numeric'],
        ]);

        $item = Pizza_size::create($validated);

        return response()->json(['item' => $item]);
    }

    public function show(string $id)
    {
        $item = Pizza_size::find($id);
        if (is_null($item)) {
            return abort(404);
        }

        return response()->json(['item' => $item]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'pizza_id' => ['required', 'numeric'],
            'size' => ['required', 'in:pequeña,mediana,grande'],
            'price' => ['required', 'numeric'],
        ]);

        $item = Pizza_size::find($id);
        if (is_null($item)) {
            return abort(404);
        }

        $item->update($validated);

        return response()->json(['item' => $item]);
    }

    public function destroy(string $id)
    {
        $item = Pizza_size::find($id);
        if (is_null($item)) {
            return abort(404);
        }

        $item->delete();

        $items = DB::table('pizza_size')
            ->join('pizzas', 'pizza_size.pizza_id', '=', 'pizzas.id')
            ->select('pizza_size.*', 'pizzas.name as pizza_name')
            ->get();

        return response()->json(['items' => $items, 'success' => true]);
    }
}
