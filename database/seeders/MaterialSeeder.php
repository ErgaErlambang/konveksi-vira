<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;
use App\Models\Types;

use DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('types')->truncate();
        DB::table('materials')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $type = Types::create([
            "name" => 'kain'
        ]);

        $materials = [
            [
                'name' => 'sutra',
                'type_id' => $type->id,
                'stock' => 10,
            ],
        ];

        foreach($materials as $material) {
            Material::create($material);
        }
    }
}
