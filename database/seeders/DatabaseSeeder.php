<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminUserSeeder::class);

        // ✅ প্রথমে ফ্যাক্টরি দিয়ে র‌্যান্ডম ইউজার বানাও
        User::factory(10)->create();

        // ✅ তারপর তোমার নিজের নির্দিষ্ট ইউজার বানাও (unique email)
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]
        );

        // ✅ Module seeders are called automatically by the modules
        // CategorySeeder is now handled by Modules\Category
        // ProductSeeder is now handled by Modules\Product
        
    }

    
}
