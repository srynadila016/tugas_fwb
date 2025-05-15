<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Pulpen',
                'description' => 'Pulpen warna hitam untuk keperluan menulis',
                'price' => 2500.00,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Buku Tulis',
                'description' => 'Buku tulis ukuran A4 dengan 100 halaman',
                'price' => 15000.00,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Penghapus',
                'description' => 'Penghapus karet berkualitas tinggi',
                'price' => 3000.00,
                'stock' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
