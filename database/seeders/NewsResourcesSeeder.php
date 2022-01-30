<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class NewsResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_resources')->insert($this->getData());
    }

    private function getData() {
        $data = [];
        $faker = Factory::create();

        for($i=0; $i<10; $i++) {
            $data[] = [
                'title' => $faker->company(),
                'url' => $faker->url(),
                'active' => $faker->boolean()
            ];
        }
        
        return $data;
    }

}