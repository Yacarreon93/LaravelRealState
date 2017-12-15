<?php

use Illuminate\Database\Seeder;

use LaravelRealState\Estate;

class EstatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            Estate::create([
                'ref' => str_random(10),
                'label' => str_random(10),
                'address' => str_random(10)
            ]);
        }
    }
}
