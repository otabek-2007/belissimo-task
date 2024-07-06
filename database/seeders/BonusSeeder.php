<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Bonus;
use App\Models\BonusItem;

class BonusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $products = Product::all();

        // Assuming we are creating a bonus for each product
        foreach ($products as $product) {
            // Create a bonus
            $bonus = Bonus::create([
                'name_uz' => $product->name_uz,
                'name_ru' => $product->name_ru,
                'description_uz' => $product->description_uz,
                'description_ru' => $product->description_ru,
                'product_id' => $product->id,
            ]);

            for ($i = 0; $i < 5; $i++) {
                BonusItem::create([
                    'bonus_id' => $bonus->id,
                    'position_id' => $product->id,
                ]);
            }
        }
    }
}
