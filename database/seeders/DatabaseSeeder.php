<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
    
        User::factory(1)->create();

        User::factory()->create([
            'name' => 'Guilherme',
            'email' => 'gui@gmail.com',
            'password' => '12345678',
         ]);
    }
}
