<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionItemsSeeder extends Seeder
{
    public function run()
    {
        DB::table('transaction_items')->insert([
            [
                'transaction_id' => 1,
                'product_id' => 1,
                'quantity' => 5,
                'subtotal' => 12500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 1,
                'product_id' => 2,
                'quantity' => 2,
                'subtotal' => 30000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
