<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Extra_ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Extra_ingredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extra_ingredients = DB::table('extra_ingredients')
            ->get();
        return json_encode(['extra_ingredients' => $extra_ingredients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric', 'regex:/^\d{1,6}(\.\d{1,2})?$/']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }

        $extra_ingredient = new Extra_ingredient();
        $extra_ingredient->name = $request->name;
        $extra_ingredient->price = $request->price;

        $extra_ingredient->save();
        return json_encode(['extra_ingredient'=>$extra_ingredient]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $extra_ingredient = Extra_ingredient::find($id);
        if(is_null($extra_ingredient)){
            return abort(404);
        }
        return json_encode(['extra_ingredient'=>$extra_ingredient]);
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
