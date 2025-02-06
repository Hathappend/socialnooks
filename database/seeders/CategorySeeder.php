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
        Category::query()->insert([
            ['name' => 'acai_shop'],
            ['name' => 'afghani_restaurant'],
            ['name' => 'african_restaurant'],
            ['name' => 'american_restaurant'],
            ['name' => 'asian_restaurant'],
            ['name' => 'bagel_shop'],
            ['name' => 'bakery'],
            ['name' => 'bar'],
            ['name' => 'bar_and_grill'],
            ['name' => 'barbecue_restaurant'],
            ['name' => 'brazilian_restaurant'],
            ['name' => 'breakfast_restaurant'],
            ['name' => 'brunch_restaurant'],
            ['name' => 'buffet_restaurant'],
            ['name' => 'cafe'],
            ['name' => 'cafeteria'],
            ['name' => 'candy_store'],
            ['name' => 'cat_cafe'],
            ['name' => 'chinese_restaurant'],
            ['name' => 'chocolate_factory'],
            ['name' => 'chocolate_shop'],
            ['name' => 'coffee_shop'],
            ['name' => 'confectionery'],
            ['name' => 'deli'],
            ['name' => 'dessert_restaurant'],
            ['name' => 'dessert_shop'],
            ['name' => 'diner'],
            ['name' => 'dog_cafe'],
            ['name' => 'donut_shop'],
            ['name' => 'fast_food_restaurant'],
            ['name' => 'fine_dining_restaurant'],
            ['name' => 'food_court'],
            ['name' => 'french_restaurant'],
            ['name' => 'greek_restaurant'],
            ['name' => 'hamburger_restaurant'],
            ['name' => 'ice_cream_shop'],
            ['name' => 'indian_restaurant'],
            ['name' => 'indonesian_restaurant'],
            ['name' => 'italian_restaurant'],
            ['name' => 'japanese_restaurant'],
            ['name' => 'juice_shop'],
            ['name' => 'korean_restaurant'],
            ['name' => 'lebanese_restaurant'],
            ['name' => 'meal_delivery'],
            ['name' => 'meal_takeaway'],
            ['name' => 'mediterranean_restaurant'],
            ['name' => 'mexican_restaurant'],
            ['name' => 'middle_eastern_restaurant'],
            ['name' => 'pizza_restaurant'],
            ['name' => 'pub'],
            ['name' => 'ramen_restaurant'],
            ['name' => 'restaurant'],
            ['name' => 'sandwich_shop'],
            ['name' => 'seafood_restaurant'],
            ['name' => 'spanish_restaurant'],
            ['name' => 'steak_house'],
            ['name' => 'sushi_restaurant'],
            ['name' => 'tea_house'],
            ['name' => 'thai_restaurant'],
            ['name' => 'turkish_restaurant'],
            ['name' => 'vegan_restaurant'],
            ['name' => 'vegetarian_restaurant'],
            ['name' => 'vietnamese_restaurant'],
            ['name' => 'wine_bar']
        ]);
    }
}
