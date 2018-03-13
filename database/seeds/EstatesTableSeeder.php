<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

use LaravelRealState\Estate;
use LaravelRealState\Owner;

class EstatesTableSeeder extends Seeder
{
    public static $num = 20;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < self::$num; $i++) {
            Estate::create([
                'ref' => str_random(10),
                'type' => str_random(10),
                'label' => str_random(10),
                'status' => str_random(10),
                'zone' => str_random(10),
                'address' => str_random(10),
                'colony' => str_random(10),
                'zip' => str_random(10),
                'price' => rand(100, 1000),
                'fk_owner' => $faker->randomElement(Owner::lists('id')->toArray())
            ]);
        }
    }
}
