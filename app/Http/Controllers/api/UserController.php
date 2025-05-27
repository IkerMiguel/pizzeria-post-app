<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $users = DB::table('users')
        ->leftJoin('employes', 'users.id', '=', 'employes.user_id') // Relación con la tabla employes
        ->leftJoin('clients', 'users.id', '=', 'clients.user_id') // Relación con la tabla clients
        ->select(
            'users.id', 'users.name', 'users.email', 'users.role', 
            'employes.*', 'clients.*', 'users.created_at', 'users.updated_at'
        )
        ->get();

    return json_encode(['users' => $users]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
