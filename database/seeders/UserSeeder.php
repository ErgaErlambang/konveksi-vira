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
            [
                'role' => 2,
                'name' => 'Admin',
                'email' => 'admin@app.com',
                'password' => Hash::make('password')
            ]
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
