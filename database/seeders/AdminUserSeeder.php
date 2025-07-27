<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
    ['email' => 'admin@example.com'], // condition
    [
        'name' => 'Admin User',
        'password' => bcrypt('password'),
        'role' => 'admin'
    ]
);

User::updateOrCreate(
    ['email' => 'seller@example.com'],
    [
        'name' => 'Seller User',
        'password' => bcrypt('password'),
        'role' => 'seller'
    ]
);

User::updateOrCreate(
    ['email' => 'wholesaler@example.com'],
    [
        'name' => 'Wholesaler User',
        'password' => bcrypt('password'),
        'role' => 'wholesaler'
    ]
);
    }
}
