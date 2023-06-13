<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $data = [
            [
                'name' => 'Super Administrator',
                'slug' => 'super-administrator'
            ],
            [
                'name' => 'admin',
                'slug' => 'admin'
            ]
        ];

        foreach($data as $role) {
            DB::table('roles')->insert([
                'name' => $role['name'],
                'slug' => $role['slug']
            ]);
        }
    }
}
