<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = DB::table('suppliers')->get();
        return json_encode(['suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'contact_info' => ['nullable', 'max:255'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->contact_info = $request->contact_info;
        $supplier->save();

        return json_encode(['supplier' => $supplier]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        if (is_null($supplier)) {
            return abort(404);
        }

        return json_encode(['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'contact_info' => ['nullable', 'max:255'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $supplier = Supplier::find($id);
        if (is_null($supplier)) {
            return abort(404);
        }

        $supplier->name = $request->name;
        $supplier->contact_info = $request->contact_info;
        $supplier->save();

        return json_encode(['supplier' => $supplier]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
