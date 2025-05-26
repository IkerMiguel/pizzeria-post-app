<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use Illuminate\Support\Facades\DB;

class BracheController extends Controller
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
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
        ]);

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->save();

        return json_encode(['branch' => $branch]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $branch = Branch::find($id);
        if (is_null($branch)) {
            return abort(404);
        }

        return json_encode(['branch' => $branch]);
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

        if ($validated->fails()) {
            return json_encode(['msj' => 'Error de validación', 'statuscode' => 400]);
        }

        $branch = Branch::find($id);
        if (is_null($branch)) {
            return abort(404);
        }

        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->save();

        return json_encode(['branch' => $branch]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
