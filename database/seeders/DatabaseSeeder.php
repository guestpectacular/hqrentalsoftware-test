<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $products = json_decode('[{"sku":"000001","name":"Full coverage insurance","category":"insurance","price":89000},{"sku":"000002","name":"Compact Car X3","category":"vehicle","price":99000},{"sku":"000003","name":"SUV Vehicle, high end","category":"vehicle","price":150000},{"sku":"000004","name":"Basic coverage","category":"insurance","price":20000},{"sku":"000005","name":"Convertible X2, Electric","category":"vehicle","price":250000}]');
        foreach ($products as $product) {

            // Since I'm allowing more than 1 category by product...
            $category = Category::firstOrCreate(['name' => $product->category]);

            $category->products()->create([
                'sku'   => $product->sku,
                'name'  => $product->name,
                'price' => $product->price,
            ]);

        }

        $insurance = Category::firstOrCreate(['name' => 'insurance']);
        $insurance->discounts()
                  ->create([
                      'percentage'  => 30,
                      'description' => 'Products in the "insurance" category have a 30% discount.'
                  ])
        ;

        $product = Product::query()->where('sku', '000003')->first();
        $product->discounts()
                ->create([
                    'percentage'  => 15,
                    'description' => 'The product with sku = 000003 has a 15% discount.',
                ])
        ;


    }
}
