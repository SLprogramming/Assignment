<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Electronics
            ['name' => 'Smartphone X', 'price' => 799.99, 'stock_qty' => 50, 'description' => 'A high-end smartphone with a stunning display.', 'discount_percentage' => 10, 'category' => 'electronics'],
            ['name' => 'Wireless Headphones', 'price' => 149.99, 'stock_qty' => 100, 'description' => 'Noise-canceling wireless headphones.', 'discount_percentage' => 0, 'category' => 'electronics'],
            ['name' => 'Laptop Pro 14', 'price' => 1299.00, 'stock_qty' => 25, 'description' => 'Powerful laptop for professionals.', 'discount_percentage' => 0, 'category' => 'electronics'],
            ['name' => 'Smart Watch Series 5', 'price' => 299.99, 'stock_qty' => 80, 'description' => 'Track your health and fitness.', 'discount_percentage' => 15, 'category' => 'electronics'],
            ['name' => 'Bluetooth Speaker', 'price' => 59.99, 'stock_qty' => 120, 'description' => 'Portable speaker with deep bass.', 'discount_percentage' => 0, 'category' => 'electronics'],
            ['name' => '4K Monitor 27"', 'price' => 349.99, 'stock_qty' => 40, 'description' => 'Ultra HD monitor for work and play.', 'discount_percentage' => 0, 'category' => 'electronics'],
            ['name' => 'Mechanical Keyboard', 'price' => 89.99, 'stock_qty' => 60, 'description' => 'Tactile feedback for faster typing.', 'discount_percentage' => 0, 'category' => 'electronics'],
            ['name' => 'Gaming Mouse', 'price' => 49.99, 'stock_qty' => 150, 'description' => 'High precision for competitive gaming.', 'discount_percentage' => 0, 'category' => 'electronics'],

            // Fashion
            ['name' => 'Classic White T-Shirt', 'price' => 19.99, 'stock_qty' => 200, 'description' => 'Comfortable cotton t-shirt.', 'discount_percentage' => 20, 'category' => 'fashion'],
            ['name' => 'Denim Jeans', 'price' => 59.99, 'stock_qty' => 150, 'description' => 'Durable and stylish jeans.', 'discount_percentage' => 0, 'category' => 'fashion'],
            ['name' => 'Leather Jacket', 'price' => 199.99, 'stock_qty' => 30, 'description' => 'Premium quality leather jacket.', 'discount_percentage' => 10, 'category' => 'fashion'],
            ['name' => 'Running Shoes', 'price' => 89.99, 'stock_qty' => 90, 'description' => 'Lightweight shoes for running.', 'discount_percentage' => 0, 'category' => 'fashion'],
            ['name' => 'Summer Dress', 'price' => 39.99, 'stock_qty' => 70, 'description' => 'Light and airy dress for summer.', 'discount_percentage' => 0, 'category' => 'fashion'],
            ['name' => 'Wool Scarf', 'price' => 25.00, 'stock_qty' => 110, 'description' => 'Warm wool scarf for winter.', 'discount_percentage' => 0, 'category' => 'fashion'],
            ['name' => 'Sunglasses Aviator', 'price' => 120.00, 'stock_qty' => 45, 'description' => 'Classic aviator sunglasses.', 'discount_percentage' => 30, 'category' => 'fashion'],
            ['name' => 'Canvas Backpack', 'price' => 45.00, 'stock_qty' => 85, 'description' => 'Durable backpack for daily use.', 'discount_percentage' => 0, 'category' => 'fashion'],

            // Home & Garden
            ['name' => 'Ceramic Table Lamp', 'price' => 45.00, 'stock_qty' => 30, 'description' => 'Elegant ceramic lamp.', 'discount_percentage' => 15, 'category' => 'home-garden'],
            ['name' => 'Succulent Plant Set', 'price' => 25.00, 'stock_qty' => 60, 'description' => 'Set of 5 succulent plants.', 'discount_percentage' => 0, 'category' => 'home-garden'],
            ['name' => 'Comfortable Sofa', 'price' => 899.00, 'stock_qty' => 10, 'description' => 'Three-seater sofa with plush cushions.', 'discount_percentage' => 0, 'category' => 'home-garden'],
            ['name' => 'Coffee Table', 'price' => 150.00, 'stock_qty' => 20, 'description' => 'Modern wooden coffee table.', 'discount_percentage' => 0, 'category' => 'home-garden'],
            ['name' => 'Kitchen Knife Set', 'price' => 79.99, 'stock_qty' => 50, 'description' => 'Professional 6-piece knife set.', 'discount_percentage' => 20, 'category' => 'home-garden'],
            ['name' => 'Throw Blanket', 'price' => 35.00, 'stock_qty' => 100, 'description' => 'Soft and cozy throw blanket.', 'discount_percentage' => 0, 'category' => 'home-garden'],
            ['name' => 'Garden Shovel', 'price' => 15.99, 'stock_qty' => 150, 'description' => 'Heavy-duty steel garden shovel.', 'discount_percentage' => 0, 'category' => 'home-garden'],

            // Sports & Outdoors
            ['name' => 'Yoga Mat', 'price' => 29.99, 'stock_qty' => 80, 'description' => 'Non-slip yoga mat.', 'discount_percentage' => 5, 'category' => 'sports-outdoors'],
            ['name' => 'Camping Tent', 'price' => 120.00, 'stock_qty' => 20, 'description' => 'Waterproof 2-person tent.', 'discount_percentage' => 25, 'category' => 'sports-outdoors'],
            ['name' => 'Dumbbell Set (10kg)', 'price' => 49.99, 'stock_qty' => 40, 'description' => 'Adjustable dumbbell set.', 'discount_percentage' => 0, 'category' => 'sports-outdoors'],
            ['name' => 'Bicycle Helmet', 'price' => 35.00, 'stock_qty' => 70, 'description' => 'Safe and lightweight helmet.', 'discount_percentage' => 0, 'category' => 'sports-outdoors'],
            ['name' => 'Basketball', 'price' => 25.00, 'stock_qty' => 100, 'description' => 'Standard size 7 basketball.', 'discount_percentage' => 0, 'category' => 'sports-outdoors'],
            ['name' => 'Hiking Boots', 'price' => 110.00, 'stock_qty' => 35, 'description' => 'Rugged boots for hiking.', 'discount_percentage' => 10, 'category' => 'sports-outdoors'],
            ['name' => 'Water Bottle 1L', 'price' => 12.99, 'stock_qty' => 200, 'description' => 'Insulated stainless steel bottle.', 'discount_percentage' => 0, 'category' => 'sports-outdoors'],

            // Beauty & Health
            ['name' => 'Facial Cleanser', 'price' => 18.00, 'stock_qty' => 150, 'description' => 'Gentle cleanser for all skin types.', 'discount_percentage' => 0, 'category' => 'beauty-health'],
            ['name' => 'Moisturizer', 'price' => 24.99, 'stock_qty' => 100, 'description' => 'Hydrating moisturizer with SPF.', 'discount_percentage' => 0, 'category' => 'beauty-health'],
            ['name' => 'Lip Balm Set', 'price' => 9.99, 'stock_qty' => 300, 'description' => 'Set of 3 organic lip balms.', 'discount_percentage' => 0, 'category' => 'beauty-health'],
            ['name' => 'Hair Dryer', 'price' => 45.00, 'stock_qty' => 55, 'description' => 'Professional hair dryer with ionic tech.', 'discount_percentage' => 15, 'category' => 'beauty-health'],
        ];

        foreach ($products as $productData) {
            $categorySlug = $productData['category'];
            unset($productData['category']);

            $product = Product::updateOrCreate(
                ['name' => $productData['name']],
                $productData
            );

            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $product->categories()->syncWithoutDetaching([$category->id]);
            }
        }
    }
}
