<?php

use Illuminate\Database\Seeder;

use LaravelRealState\Owner;

class OwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            Owner::create([
                'name' => str_random(10),
                'email' => str_random(10).'@gmail.com',
                'phone' => str_random(10),
                'address' => str_random(10)
            ]);
        }
    }
}
