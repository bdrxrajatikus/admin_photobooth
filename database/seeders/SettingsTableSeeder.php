<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            'application_name' => 'BLURRED',
            'master_price' => 10000,
            'homepage_image' => 'homepage.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
