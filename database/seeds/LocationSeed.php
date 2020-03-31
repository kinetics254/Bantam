<?php

use Illuminate\Database\Seeder;

class LocationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Location::insert([
            ['Code' => 'LOC001',  'Name' => 'The First Location'],
            ['Code' => 'LOC002',  'Name' => 'The Second Location'],
            ['Code' => 'LOC003',  'Name' => 'The Third Location'],
        ]);
    }
}
