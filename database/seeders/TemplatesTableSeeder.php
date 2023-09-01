<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplatesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('templates')->insert([
            'name' => 'Template 1',
            'image' => 'template1.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('templates')->insert([
            'name' => 'Template 2',
            'image' => 'template2.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
