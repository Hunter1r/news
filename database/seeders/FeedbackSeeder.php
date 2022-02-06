<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedbacks')->insert($this->getData());
    }

    private function getData() {
        $data = [];
        $faker = Factory::create();

        for($i=0; $i<10; $i++) {
            $data[] = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'feedback' => $faker->realText(200,2),
        ];
        }
        
        return $data;
    }

}
