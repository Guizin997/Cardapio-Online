<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::orderBy('id')->get();
    $products = Product::all();

    $basePrice = 0;

    $data = [];

    foreach ($orders as $order) {
    $product = $products->firstWhere('id', $order->product_id);

    $item = [
        'order_id'      => $order->id,
        'user_id'       => $order->user_id,
        'product_id'    => $order->product_id,
        'product_name'  => $product?->name,
        'product_price' => $product ? number_format($product->price, 2, ',', '.') : null, // <-- Aqui
        'product_image' => $product?->image,
        'quantity'      => $order->quantity,
        'status'        => $order->status,
        'created_at'    => $order->created_at,
        'updated_at'    => $order->updated_at,
    ];

    if ($product) {
        $basePrice += $product->price * $order->quantity;
    }

    $data[] = $item;
}


    $tax = 5.99;
    $total = $basePrice + $tax;

    return response()->json([
        'success' => true,
        'data' => [
            'pedidos' => $data,
            'resumo' => [
    'preco_base' => number_format($basePrice, 2, ',', '.'), 
    'taxa'       => number_format($tax, 2, ',', '.'),
    'total'      => number_format($total, 2, ',', '.'),
]

        ]
    ], 200);
}



    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'    => ['required', 'integer'],
            'product_id' => ['required', 'integer'],
            'quantity'   => ['required', 'integer'],
            'status'     => ['required', 'string', 'max:255'],
        ]);

        $order = Order::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pedido criado com sucesso.',
            'data'    => $order
        ], 201);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pedido não encontrado.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pedido não encontrado.'
            ], 404);
        }

        $validated = $request->validate([
            'user_id'    => ['required', 'integer'],
            'product_id' => ['required', 'integer'],
            'quantity'   => ['required', 'integer'],
            'status'     => ['required', 'string', 'max:255'],
        ]);

        $order->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pedido atualizado com sucesso.',
            'data' => $order
        ], 200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pedido não encontrado.'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pedido excluído com sucesso.'
        ], 200);
    }
}
