<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@uddn.edu'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password123'),
            ]
        );
    }
}
