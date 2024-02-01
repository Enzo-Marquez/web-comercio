<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory()->create([
            'user_type' => \App\Enums\UserType::Admin,
            'name' => 'Admin',
            'email' => 'admin@adminlte.com',
        ]);
    }
}