<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
{
    $favorites = Favorite::with('product')
        ->where('user_id', Auth::id())
        ->orderBy('id')
        ->get();

    $data = $favorites->map(function ($fav) {
        return [
            'id'            => $fav->id,
            'product_id'    => $fav->product_id,
            'product_name'  => $fav->product->name ?? null,
            'product_price' => $fav->product ? number_format($fav->product->price, 2, ',', '.') : null,
            'product_image'    => $fav->product->image ?? null,
            'created_at'    => $fav->created_at,
            'updated_at'    => $fav->updated_at,
        ];
    });

    return response()->json([
        'success' => true,
        'data' => $data
    ], 200);
}


    // store e destroy continuam iguais
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
        ]);

        $alreadyExists = Favorite::where('user_id', Auth::id())
            ->where('product_id', $validated['product_id'])
            ->exists();

        if ($alreadyExists) {
            return response()->json([
                'success' => false,
                'message' => 'Produto já está nos favoritos.'
            ], 409);
        }

        $favorite = Favorite::create([
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produto adicionado aos favoritos com sucesso.',
            'data' => $favorite
        ], 201);
    }

    public function destroy($id)
    {
        $favorite = Favorite::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$favorite) {
            return response()->json([
                'success' => false,
                'message' => 'Favorito não encontrado ou não pertence ao usuário.'
            ], 404);
        }

        $favorite->delete();

        return response()->json([
            'success' => true,
            'message' => 'Favorito removido com sucesso.'
        ], 200);
    }
}
