<?php

namespace Database\Seeders;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    private function getData() {
        $data = [];
        $faker = Factory::create();

        for($i=0; $i<10; $i++) {
            $data[] = ['name' => $faker->word()];
        }
        
        return $data;
    }
}
