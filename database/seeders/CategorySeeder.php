<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Latest gadgets, computers, and electronics.',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Clothing, shoes, and accessories for everyone.',
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Furniture, decor, and gardening tools.',
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Gear for sports, camping, and outdoor activities.',
            ],
            [
                'name' => 'Beauty & Health',
                'description' => 'Skincare, makeup, and wellness products.',
            ],
            [
                'name' => 'Books & Stationery',
                'description' => 'Books, notebooks, and office supplies.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                ]
            );
        }
    }
}
