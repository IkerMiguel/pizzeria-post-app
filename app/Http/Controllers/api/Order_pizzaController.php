<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Order_pizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders_pizza = DB::table('orders_pizza')
            ->join('orders', 'orders_pizza.order_id', '=', 'orders.id')
            ->join('pizza_size', 'orders_pizza.pizza_size_id', '=', 'pizza_size.id')
            ->join('pizzas', 'pizza_size.pizza_id', '=', 'pizzas.id')
            ->select(
                'orders_pizza.id',
                'orders.status as order_status',
                'pizza_size.size as pizza_size',
                'pizzas.name as pizza_name',
                'orders_pizza.quantity'
            )
            ->orderBy('orders_pizza.id', 'asc')
            ->get();
        return json_encode(['orders_pizza'=>$orders_pizza]);
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
