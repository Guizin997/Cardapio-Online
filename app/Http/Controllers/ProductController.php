<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::orderBy('id')->get()->map(function ($product) {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => number_format($product->price, 2, ',', '.'), // <-- Aqui
            'image' => $product->image,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ];
    });

    return response()->json([
        'success' => true,
        'data' => $products
    ], 200);
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Produto criado com sucesso.',
            'data' => $product
        ], 201);
    }

    public function show(Product $product)
    {
        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string',
        ]);

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Produto atualizado com sucesso.',
            'data' => $product
        ], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produto excluído com sucesso.'
        ], 200);
    }
}
