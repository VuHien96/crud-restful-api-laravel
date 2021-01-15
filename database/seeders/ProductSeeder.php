<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->name = "Sản phẩm $i";
            $product->description = "Nội dung sản phẩm $i";
            $product->price = 450 * $i;
            $product->category_id = 1;
            $product->status = 1;
            $product->save();
        }

    }
}
