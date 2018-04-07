<?php

use Illuminate\Database\Seeder;

class DictionariesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'house',
            'department'
        ];
        for ($i = 0; $i < count($types); $i++) {
            DB::table('estates_types')->insert([
                'name' => $types[$i]
            ]);
        }
    }
}
