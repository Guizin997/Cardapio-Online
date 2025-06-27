<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Hambúrguer Clássico',
                'description' => 'Pão, hambúrguer 100% bovino, queijo cheddar, alface, tomate e molho especial.',
                'price' => 22.90,
                'image' => 'https://www.unileverfoodsolutions.pt/dam/global-ufs/mcos/portugal/calcmenu/recipes/PT-recipes/In-Development/hamb%C3%BArguer-cl%C3%A1ssico/main-header.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cheeseburger Bacon',
                'description' => 'Pão, hambúrguer bovino, queijo cheddar, bacon crocante e molho barbecue.',
                'price' => 28.50,
                'image' => 'https://www.sargento.com/assets/Meta/cheddarbaconcheeseburger__FocusFillWyIwLjAwIiwiMC4wMCIsMTAyNCw1MTJd.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Batata Frita Média',
                'description' => 'Batata frita crocante, servida quente e sequinha.',
                'price' => 12.00,
                'image' => 'https://cdn.casaeculinaria.com/wp-content/uploads/2023/03/13101208/Batata-frita.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Refrigerante Lata',
                'description' => 'Refrigerante gelado de 350ml, várias opções de sabores.',
                'price' => 7.50,
                'image' => 'https://changlee.com.br/wp-content/uploads/2016/09/coca-cola.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Veggie Burger',
                'description' => 'Hambúrguer vegetariano feito com grão-de-bico, legumes frescos e molho especial.',
                'price' => 26.90,
                'image' => 'https://www.eatingwell.com/thmb/bKG34-yS8FjpBQH77B1pXgsjcms=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/EW-Zucchini-Chickpea-Veggie-Burgers-with-Tahini-Ranch-Sauce-1x1-c6d1c8e20e3144bf95063134a4a518a8.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
