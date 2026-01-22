<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tumbalperang.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'tribe_id' => null // admin tidak perlu tribe
        ]);
    }
}
