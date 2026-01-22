<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <= WAJIB DITAMBAHKAN

class BuildingSeeder extends Seeder
{
    public function run()
    {
        DB::table('buildings')->insert([
            [
                'name' => 'Bangunan Utama',
                'price' => 0,
                'gold_per_minute' => 0,
                'troop_per_minute' => 0,
                'defense_bonus' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Tambang',
                'price' => 100,
                'gold_per_minute' => 10,
                'troop_per_minute' => 0,
                'defense_bonus' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Barak',
                'price' => 150,
                'gold_per_minute' => 0,
                'troop_per_minute' => 5,
                'defense_bonus' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Pagar',
                'price' => 200,
                'gold_per_minute' => 0,
                'troop_per_minute' => 0,
                'defense_bonus' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
