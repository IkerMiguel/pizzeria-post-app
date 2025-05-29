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
        $validate = Validator::make($request->all(), [
            'pizza_id' => ['required', 'numeric', 'min:1'],
            'ingredient_id' => ['required', 'numeric', 'min:1']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }

        $pizza_ingredient = new Pizza_ingredient();

        $pizza_ingredient->pizza_id = $request->pizza_id;
        $pizza_ingredient->ingredient_id = $request->ingredient_id;
        $pizza_ingredient->save();

        return json_encode(['pizza_ingredient'=>$pizza_ingredient]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pizza_ingredient = DB::table('pizza_ingredient')
        ->join('pizzas', 'pizza_ingredient.pizza_id', '=', 'pizzas.id')
        ->join('ingredients', 'pizza_ingredient.ingredient_id', '=', 'ingredients.id')
        ->select(
            'pizza_ingredient.*',
            'pizzas.name as pizza_name',
            'ingredients.name as ingredient_name'
        )
        ->where('pizza_ingredient.id', $id)
        ->first();

        if(is_null($pizza_ingredient)){
            return abort(404);
        }
        return json_encode(['pizza_ingredient'=>$pizza_ingredient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'pizza_id' => ['required', 'numeric', 'min:1'],
            'ingredient_id' => ['required', 'numeric', 'min:1']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }

        $pizza_ingredient = Pizza_ingredient::find($id);

        if(is_null($pizza_ingredient)){
            return abort(404);
        }

        $pizza_ingredient->pizza_id = $request->pizza_id;
        $pizza_ingredient->ingredient_id = $request->ingredient_id;
        $pizza_ingredient->save();

        return json_encode(['pizza_ingredient'=>$pizza_ingredient]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pizza_ingredient = Pizza_ingredient::find($id);

        if(is_null($pizza_ingredient)){
            return abort(404);
        }
        $pizza_ingredient->delete();
        return json_encode(['pizza_ingredient'=>$pizza_ingredient, 'success'=> true]);
    }
}
