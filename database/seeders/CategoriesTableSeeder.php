<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        $faker = \Faker\Factory::create();

        for($i=1;$i<=3;$i++){
            Category::create([
                'description' => $faker->sentence,
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
