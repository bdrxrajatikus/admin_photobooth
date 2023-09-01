<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('transactions')->insert([
            'transaction_date' => now(),
            'phone_number' => '1234567890',
            'price' => 50.00,
            'promo_code_id' => null, // Set to null if there is no promo code
            'final_price' => 50.00,
            'status' => 'success',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
