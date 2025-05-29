<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use Illuminate\Support\Facades\DB;

class BrancheController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index()
    {
        $branches = DB::table('branches')->get();
        return json_encode(['branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*$validated = $request->validate([
            'name' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }*/

        $branche = new Branche();
        $branche->name = $request->name;
        $branche->address = $request->address;
        $branche->save();

        return json_encode(['branche' => $branche]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $branche = Branche::find($id);
        if (is_null($branche)) {
            return abort(404);
        }

        return json_encode(['branche' => $branche]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
        'name' => ['required', 'max:255'],
        'address' => ['required', 'max:255'],
        ]);

        $branche = Branche::find($id);
        if (is_null($branche)) {
            return abort(404);
        }

        $branche->name = $request->name;
        $branche->address = $request->address;
        $branche->save();

        return json_encode(['branche' => $branche]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $branche = Branche::find($id);
        if (is_null($branche)) {
            return abort(404);
        }

        $branche->delete();

        $branches = DB::table('branches')->get();
        return json_encode(['branches' => $branches, 'success' => true]);
    }
}
