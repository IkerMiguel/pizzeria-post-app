<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\order;
use Illuminate\Support\Facades\Validator;

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
        $validate = Validator::make($request->all(), [
            'client_id' => ['required', 'exists:clients,id'],
            'branch_id' => ['required', 'exists:branches,id'],
            'delivery_person_id' => ['nullable', 'exists:employees,id'],
            'total_price' => ['required', 'numeric', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'status' => ['required', 'in:pendiente,en_preparacion,listo,entregado'],
            'delivery_type' => ['required', 'in:en_local,a_domicilio']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }

        $order = new Order();
        $order->client_id = $request->client_id;
        $order->branch_id = $request->branch_id;
        $order->delivery_person_id = $request->delivery_person_id;
        $order->total_price = $request->total_price;
        $order->status = $request->status;
        $order->delivery_type = $request->delivery_type;
        $order->save();

        return json_encode(['order' => $order]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = DB::table('orders')
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
            ->where('orders.id', $id)
            ->first();

        if (!$order) {
            return response()->json([
                'msg' => 'Orden no encontrada.',
                'statusCode' => 404
            ]);
        }

        return json_encode(['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => ['required', 'numeric', 'min:1'],
            'branch_id' => ['required', 'numeric', 'min:1'],
            'total_price' => ['required', 'numeric', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'status' => ['required', 'in:pendiente,en_preparacion,listo,entregado'],
            'delivery_type' => ['required', 'in:en_local,a_domicilio']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }

        $order = Order::find($id);

        if(is_null($order)){
            return abort(404);
        }

        $order->client_id = $request->client_id;
        $order->branch_id = $request->branch_id;
        $order->total_price = $request->total_price;
        $order->status = $request->status;
        $order->delivery_type = $request->delivery_type;
        $order->delivery_person_id = $request->delivery_person_id;
        $order->save();

        return json_encode(['order' => $order]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
