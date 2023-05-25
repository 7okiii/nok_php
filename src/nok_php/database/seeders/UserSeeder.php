<?php

namespace Database\Seeders;

use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' => 'naoki',
            'email' => 'naoki@test.com',
            'password' => Hash::make('naoki123'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}