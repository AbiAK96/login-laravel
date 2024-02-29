<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        MenuCategory::create([
            'category' => 'Pizza',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MenuCategory::create([
            'category' => 'Desserts',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
