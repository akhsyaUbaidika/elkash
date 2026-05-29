<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::updateOrCreate(
        ['slug' => 'coffee'],
        [
            'name' => 'Coffee',
            'description' => 'Coffee and espresso based beverages',
        ]
    );

    Category::updateOrCreate(
        ['slug' => 'snack'],
        [
            'name' => 'Snack',
            'description' => 'Light meals and appetizers',
        ]
    );

    Category::updateOrCreate(
        ['slug' => 'main-course'],
        [
            'name' => 'Main Course',
            'description' => 'Main dishes and meals',
        ]
    );
    }
}