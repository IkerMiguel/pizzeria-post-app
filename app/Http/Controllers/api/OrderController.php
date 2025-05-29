<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = DB::table('orders')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('users as client_users', 'clients.user_id', '=', 'client_users.id')
            ->join('branches', 'orders.branch_id', '=', 'branches.id')
            ->leftJoin('employees', 'orders.delivery_person_id', '=', 'employees.id')
            ->leftJoin('users as employees_users', 'employees.user_id', '=', 'employees_users.id')
            ->select(
                'orders.id',
                'client_users.name as client_name',
                'branches.name as branch_name',
                'orders.total_price',
                'orders.status',
                'orders.delivery_type',
                'employees_users.name as employees_name'
            )
            ->get();
        return json_encode(['orders' => $orders]);
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
