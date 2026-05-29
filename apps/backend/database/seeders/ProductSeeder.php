<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(
            database_path('seeders/data/menu.json')
        );

        $menus = json_decode($json, true)['data'];

        $coffeeId = Category::where('slug', 'coffee')->value('id');
        $snackId = Category::where('slug', 'snack')->value('id');
        $mainCourseId = Category::where('slug', 'main-course')->value('id');

        $coffeeKeywords = [
            'americano',
            'espresso',
            'latte',
            'cappuccino',
            'brew',
            'kopi',
            'affogato'
        ];

        foreach ($menus as $index => $item) {

            $categoryId = $mainCourseId;

            $name = strtolower($item['name']);

            if (
                collect($coffeeKeywords)
                    ->contains(fn ($keyword) => str_contains($name, $keyword))
            ) {
                $categoryId = $coffeeId;
            }

            elseif (
                str_contains($name, 'karaage') ||
                str_contains($name, 'wings') ||
                str_contains($name, 'fries') ||
                str_contains($name, 'nachos') ||
                str_contains($name, 'cireng') ||
                str_contains($name, 'pisang') ||
                str_contains($name, 'risol') ||
                str_contains($name, 'edamame') ||
                str_contains($name, 'singkong') ||
                str_contains($name, 'spring roll') ||
                str_contains($name, 'tahu')
            ) {
                $categoryId = $snackId;
            }

            Product::create([
                'category_id' => $categoryId,
                'supplier_id' => null,

                'sku' => sprintf(
                    'PRD-%06d',
                    $index + 1
                ),

                'name' => $item['name'],

                'slug' => Str::slug($item['name']),

                'description' => $item['description'] ?: null,

                'price' => $item['price'],

                'cost_price' => null,

                'stock_quantity' => 0,

                'minimum_stock' => 0,

                'is_available' => $item['available'],

                'is_favorite' => $item['favorite'],

                'image_url' => $item['image'],
            ]);
        }
    }
}