<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = DB::table('ingredients')
            ->get();
        return json_encode(['ingredients'=>$ingredients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:255']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }

        $ingredient = new Ingredient();
        $ingredient->name = $request->name;
        $ingredient->save();

        return json_encode(['ingredient'=>$ingredient]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ingredient = Ingredient::find($id);
        if(is_null($ingredient)){
            return abort(404);
        }
        return json_encode(['ingredient'=>$ingredient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:255']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }
        $ingredient = Ingredient::find($id);
        if(is_null($ingredient)){
            return abort(404);
        }
        $ingredient->name = $request->name;
        $ingredient->save();

        return json_encode(['ingredient'=>$ingredient]);
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->delete();
        return json_encode(['ingredient'=>$ingredient, 'success'=> true]);
    }
}
