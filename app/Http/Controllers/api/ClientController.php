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
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->leftJoin('orders', 'clients.id', '=', 'orders.client_id')
            ->select('clients.*', 'users.name as user_name', DB::raw('COUNT(orders.id) as orders_count'))
            ->groupBy('clients.id', 'users.name')
            ->get();

        return json_encode(['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'user_id' => ['required', 'numeric'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        // Crear un nuevo cliente
        $client = new Client();
        $client->user_id = $request->user_id;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        return json_encode(['client' => $client]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        $client = Client::find($id);
        if (is_null($client)) {
            return abort(404);
        }

        // Obtener también las órdenes del cliente
        $client->load('orders');
        
        return json_encode(['client' => $client]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'numeric'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        // Buscar el cliente y actualizar los datos
        $client = Client::find($id);
        if (is_null($client)) {
            return abort(404);
        }

        $client->user_id = $request->user_id;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->save();

        return json_encode(['client' => $client]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
