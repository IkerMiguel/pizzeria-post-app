<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Raw_material;
use Illuminate\Support\Facades\DB;

class Raw_materialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = DB::table('raw_materials')->get();
        return json_encode(['raw_materials' => $materials]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'unit' => ['required', 'max:50'],
            'current_stock' => ['required', 'numeric'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $material = new RawMaterial();
        $material->name = $request->name;
        $material->unit = $request->unit;
        $material->current_stock = $request->current_stock;
        $material->save();

        return json_encode(['raw_material' => $material]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = RawMaterial::find($id);
        if (is_null($material)) {
            return abort(404);
        }

        return json_encode(['raw_material' => $material]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'unit' => ['required', 'max:50'],
            'current_stock' => ['required', 'numeric'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $material = RawMaterial::find($id);
        if (is_null($material)) {
            return abort(404);
        }

        $material->name = $request->name;
        $material->unit = $request->unit;
        $material->current_stock = $request->current_stock;
        $material->save();

        return json_encode(['raw_material' => $material]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = RawMaterial::find($id);
        if (is_null($material)) {
            return abort(404);
        }

        $material->delete();

        $materials = DB::table('raw_materials')->get();
        return json_encode(['raw_materials' => $materials, 'success' => true]);
    }
}
