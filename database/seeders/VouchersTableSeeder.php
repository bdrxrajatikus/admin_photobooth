<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VouchersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('vouchers')->insert([
            'promo_code' => 'GEBRAKANMERDEKA',
            'promo_name' => 'DISCOUNT KHUSUS MEMBER',
            'description' => 'Get 20% off for summer products',
            'qty' => 100,
            'is_percentage' => true,
            'amount' => 20.00,
            'usage' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
