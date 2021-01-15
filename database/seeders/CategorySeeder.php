<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
            $category = new Category();
            $category->name = "Danh mục $i";
            $category->description = "Nội dung danh mục $i";
            $category->save();
        }
    }
}
