<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Technika']);
        Category::create(['name' => 'Iskola']);
        Category::create(['name' => 'Zene']);
        Category::create(['name' => 'Háztartás']);
    }
}
