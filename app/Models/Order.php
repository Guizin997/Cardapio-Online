<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calcula resumo dos pedidos do usuário: preço base, taxa fixa e total.
     */
    public static function calcularResumoPorUsuario($userId)
    {
        $pedidos = self::with('product')->where('user_id', $userId)->get();

        $precoBase = 0;
        foreach ($pedidos as $pedido) {
            if ($pedido->product) {
                $precoBase += $pedido->product->price * $pedido->quantity;
            }
        }

        $taxa = 5.99;
        $total = $precoBase + $taxa;

        return [
            'preco_base' => number_format($precoBase, 2, '.', ''),
            'taxa_fixa' => number_format($taxa, 2, '.', ''),
            'total' => number_format($total, 2, '.', ''),
            'pedidos' => $pedidos
        ];
    }
}
