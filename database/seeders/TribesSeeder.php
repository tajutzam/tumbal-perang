<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tribe;

class TribesSeeder extends Seeder
{
    public function run(): void
    {
        Tribe::create([
            'name' => 'Marksman',
            'attack_magic' => 1,
            'attack_range' => 9,
            'attack_melee' => 2,
            'def_magic' => 2,
            'def_range' => 3,
            'def_melee' => 1,
        ]);

        Tribe::create([
            'name' => 'Tank',
            'attack_magic' => 1,
            'attack_range' => 1,
            'attack_melee' => 1,
            'def_magic' => 8,
            'def_range' => 7,
            'def_melee' => 9,
        ]);

        Tribe::create([
            'name' => 'Mage',
            'attack_magic' => 10,
            'attack_range' => 1,
            'attack_melee' => 1,
            'def_magic' => 1,
            'def_range' => 2,
            'def_melee' => 1,
        ]);

        Tribe::create([
            'name' => 'Warrior',
            'attack_magic' => 1,
            'attack_range' => 2,
            'attack_melee' => 8,
            'def_magic' => 2,
            'def_range' => 2,
            'def_melee' => 6,
        ]);
    }
}
