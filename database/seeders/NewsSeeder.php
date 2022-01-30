<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    private function getData() {
        $data = [];
        $faker = Factory::create();

        for($i=0; $i<10; $i++) {
            $data[] = [
                'date' => $faker->date(),
                'title' => $faker->sentence(rand(5,10)),
                'slug' => $faker->slug(),
                'author' => $faker->name(),
                'active' => $faker->boolean(),
                'description' => $faker->text(rand(10,20)),
                'category_id' => rand(1,10),
        ];
        }
        
        return $data;
    }
}
