<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\RawMaterial;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $purchases = DB::table('purchases')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('raw_materials', 'purchases.raw_material_id', '=', 'raw_materials.id')
            ->select(
                'purchases.*',
                'suppliers.name as supplier_name',
                'raw_materials.name as raw_material_name'
            )
            ->orderBy('purchases.purchase_date', 'desc')
            ->get();

        return response()->json(['purchases' => $purchases]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|numeric|exists:suppliers,id',
            'raw_material_id' => 'required|numeric|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0.01',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date'
        ]);

        $purchase = new Purchase();
        $purchase->supplier_id = $request->supplier_id;
        $purchase->raw_material_id = $request->raw_material_id;
        $purchase->quantity = $request->quantity;
        $purchase->purchase_price = $request->purchase_price;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->save();

        return response()->json(['purchase' => $purchase], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json(['message' => 'Compra no encontrada.'], 404);
        }

        $suppliers = Supplier::orderBy('name')->get();
        $rawMaterials = RawMaterial::orderBy('name')->get();

        return response()->json([
            'purchase' => $purchase,
            'suppliers' => $suppliers,
            'raw_materials' => $rawMaterials
        ]);
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
