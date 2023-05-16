<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'username' => 'TestUser1',
            'email' => 'test@gmail.com',
            'google_id' => '123456789012345678901',
            'password' => bcrypt('testuser1'),
        ]);

        $user = User::create([
            'name' => 'Test User 2',
            'username' => 'TestUser2',
            'email' => 'test2@gmail.com',
            'google_id' => '420420420420420420420',
            'password' => bcrypt('testuser2'),
        ]);
    }
}
