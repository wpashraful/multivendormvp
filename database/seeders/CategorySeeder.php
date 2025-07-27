<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::updateOrCreate(
        ['slug' => 'electronics'], // শর্ত: slug যদি থাকে, আপডেট করবে
        ['name' => 'Electronics', 'status' => true]
    );

    Category::updateOrCreate(
        ['slug' => 'fashion'], // শর্ত: slug যদি থাকে, আপডেট করবে
        ['name' => 'Fashion', 'status' => true]
    );
    }
}
