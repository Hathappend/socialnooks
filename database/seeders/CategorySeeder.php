<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'acai_shop',
            'afghani_restaurant',
            'african_restaurant',
            'american_restaurant',
            'asian_restaurant',
            'bagel_shop',
            'bakery',
            'bar',
            'bar_and_grill',
            'barbecue_restaurant',
            'brazilian_restaurant',
            'breakfast_restaurant',
            'brunch_restaurant',
            'buffet_restaurant',
            'cafe',
            'cafeteria',
            'candy_store',
            'cat_cafe',
            'chinese_restaurant',
            'chocolate_factory',
            'chocolate_shop',
            'coffee_shop',
            'confectionery',
            'deli',
            'dessert_restaurant',
            'dessert_shop',
            'diner',
            'dog_cafe',
            'donut_shop',
            'fast_food_restaurant',
            'fine_dining_restaurant',
            'food_court',
            'french_restaurant',
            'greek_restaurant',
            'hamburger_restaurant',
            'ice_cream_shop',
            'indian_restaurant',
            'indonesian_restaurant',
            'italian_restaurant',
            'japanese_restaurant',
            'juice_shop',
            'korean_restaurant',
            'lebanese_restaurant',
            'meal_delivery',
            'meal_takeaway',
            'mediterranean_restaurant',
            'mexican_restaurant',
            'middle_eastern_restaurant',
            'pizza_restaurant',
            'pub',
            'ramen_restaurant',
            'restaurant',
            'sandwich_shop',
            'seafood_restaurant',
            'spanish_restaurant',
            'steak_house',
            'sushi_restaurant',
            'tea_house',
            'thai_restaurant',
            'turkish_restaurant',
            'vegan_restaurant',
            'vegetarian_restaurant',
            'vietnamese_restaurant',
            'wine_bar',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }

    }
}
