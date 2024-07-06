<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('bonus_items')->truncate();
        DB::table('bonuses')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $jsonPath = storage_path('app/public/data.json');

        if (!File::exists($jsonPath)) {
            throw new \Exception("File does not exist at path: {$jsonPath}");
        }

        $json = File::get($jsonPath);

        $data = json_decode($json, true);

        if (is_null($data) || !isset($data['result'])) {
            throw new \Exception('Invalid JSON structure');
        }

        foreach ($data['result'] as $categoryData) {
            $category = Category::updateOrCreate(
                ['id' => $categoryData['id']],
                [
                    'name_uz' => $categoryData['name_uz'],
                    'name_ru' => $categoryData['name_ru'],
                    'parent_id' => $categoryData['parent_id'],
                    'has_subcategory' => $categoryData['has_subcategory'],
                    'is_pizza' => $categoryData['is_pizza'],
                    'photo' => $categoryData['photo'],
                    'link' => $categoryData['link'],
                    'position' => $categoryData['position'],
                    'created_at' => $categoryData['created_at'],
                    'updated_at' => $categoryData['updated_at'],
                ]
            );

            foreach ($categoryData['products'] as $productData) {
                $category->products()->updateOrCreate(
                    ['id' => $productData['id']],
                    [
                        'name_uz' => $productData['name_uz'],
                        'name_ru' => $productData['name_ru'],
                        'description_uz' => $productData['description_uz'],
                        'description_ru' => $productData['description_ru'],
                        'price_small' => $productData['price_small'],
                        'price_medium' => $productData['price_medium'],
                        'price_big' => $productData['price_big'],
                        'photo' => $productData['photo'],
                        'category_id' => $productData['category_id'],
                        'in_stock' => $productData['in_stock'],
                        'is_pizza' => $productData['is_pizza'],
                        'code' => $productData['code'],
                        'package_code' => $productData['package_code'],
                        'vat_percent' => $productData['vat_percent'],
                        'position' => $productData['position'],
                        'created_at' => $productData['created_at'],
                        'updated_at' => $productData['updated_at'],
                    ]
                );
            }
        }

        $this->call(BonusSeeder::class);
    }
}
