<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        return Favorite::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);

        return Favorite::create($request->all());
    }

    public function destroy(Favorite $favorite)
    {
        $favorite->delete();
        return response()->noContent();
    }
}
