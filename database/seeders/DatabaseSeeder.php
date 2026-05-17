<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'seller@example.com'],
            ['name' => 'Seller Demo', 'password' => Hash::make('password'), 'role' => 'seller']
        );

        User::updateOrCreate(
            ['email' => 'buyer@example.com'],
            ['name' => 'Buyer Demo', 'password' => Hash::make('password'), 'role' => 'buyer']
        );
    }
}
