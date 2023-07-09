<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $data = [
            [
                'role' => 1,
                'name' => 'Super Administrator',
                'email' => 'superadministrator@app.com',
                'password' => Hash::make('password')
            ],
            // Admin
            [
                'role' => 2,
                'name' => 'Admin',
                'email' => 'admin@app.com',
                'password' => Hash::make('password')
            ],
            // Produksi
            [
                'role' => 3,
                'name' => 'Produksi',
                'email' => 'production@app.com',
                'password' => Hash::make('password')
            ],
            // Owner
            [
                'role' => 4,
                'name' => 'Pemilik',
                'email' => 'owner@app.com',
                'password' => Hash::make('password')
            ],
            // Bahan baku
            [
                'role' => 5,
                'name' => 'K. Bahan Baku',
                'email' => 'bahan@app.com',
                'password' => Hash::make('password')
            ],
            // User
            [
                'role' => 6,
                'name' => 'User',
                'email' => 'user@app.com',
                'password' => Hash::make('password')
            ],
        ];

        foreach ($data as $user) {
            DB::table('users')->insert([
                'role_id' => $user['role'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password']
            ]);
        }

    }
}
