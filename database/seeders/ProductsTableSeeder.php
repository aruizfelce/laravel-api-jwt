<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        $faker = \Faker\Factory::create();

        for($i=1;$i<=9;$i++){
            Product::create([
                'description' => $faker->sentence,
                'unit'=> $faker->word,
                'image'=>$faker->imageUrl(400,300, null, false),
                'id_category'=> $faker->numberBetween(1, 3)
            ]);
        }
    }
}
