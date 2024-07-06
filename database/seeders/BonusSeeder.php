<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Bonus;
use App\Models\BonusItem;

class BonusSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all(['id', 'position', 'name_ru']);

        $positions = $products->keyBy('position')->toArray();

        for ($i = 0; $i <= 13; $i++) {
            $bonus = Bonus::create([
                'name_uz' => 'Katta bazm ' . ($i + 1),
                'name_ru' => 'Большая вечеринка ' . ($i + 1),
                'description_uz' => "4 ta 30 sm’lik pitsa va 2 ta Coca-Cola 1,5 L — katta davra uchun mo’ljallangan set.",
                'description_ru' => "4 пиццы по 30 см и 2 кока-колы 1,5 л - набор для большого круга.",
            ]);

            $shuffledPositions = array_keys($positions);
            shuffle($shuffledPositions);
            $randomPositions = array_slice($shuffledPositions, 0, 5);

            foreach ($randomPositions as $position) {
                $product = $positions[$position];

                BonusItem::create([
                    'bonus_id' => $bonus->id,
                    'name_ru' => $product['name_ru'],
                    'position_id' => $product['id'],
                ]);
            }
        }
    }
}
