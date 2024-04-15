<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Nizam',
            'email' => 'nizaamomer@gmail.com',
            'email_verified_at' => now(),
            'phoneNumber' => '07501685710',
            'user_id' => '1',
            'password' =>Hash::make("password"),
            'status' =>'active',
            'isAdmin' =>1,
        ]);
    }
}
