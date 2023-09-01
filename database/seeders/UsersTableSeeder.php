<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan satu pengguna admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'image' => 'admin.jpg',
            'password' => Hash::make('adminpassword'),
            'level' => 'admin',
            'created_at' => now(),
        ]);

        // Menambahkan beberapa pengguna
        DB::table('users')->insert([
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'image' => 'user1.jpg',
            'password' => Hash::make('userpassword'),
            'level' => 'user',
            'created_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'User 2',
            'email' => 'user2@example.com',
            'image' => 'user2.jpg',
            'password' => Hash::make('userpassword'),
            'level' => 'user',
            'created_at' => now(),
        ]);

        // Tambahkan lebih banyak data pengguna sesuai kebutuhan Anda
    }
}
