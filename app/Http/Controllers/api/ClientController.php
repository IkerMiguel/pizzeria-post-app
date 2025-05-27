<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = DB::table('clients')
            ->join('users', 'clients.user_id', '=', 'users.id') // Suponiendo que cada cliente tiene un 'user_id' que es una clave foránea a 'users'
            ->select('clients.*', 'users.name as user_name', 'users.email as user_email')
            ->get();

        return json_encode(['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $client = new Client();
        $client->name = $request->name;
        $client->user_id = $request->user_id; // Se espera que el cliente tenga un 'user_id' como clave foránea
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        // Obtener todos los clientes nuevamente con la información del usuario
        $clients = DB::table('clients')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->select('clients.*', 'users.name as user_name', 'users.email as user_email')
            ->get();

        return json_encode(['clients' => $clients]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
