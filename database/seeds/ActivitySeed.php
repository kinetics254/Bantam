<?php

use Illuminate\Database\Seeder;

class ActivitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Activity::insert([
            ['Code' => 'ACT001',  'Description' => 'The First Activity', 'Max_hours' => '10', 'Min_hours' => '6'],
            ['Code' => 'ACT002',  'Description' => 'The Second Activity', 'Max_hours' => '10', 'Min_hours' => '6'],
            ['Code' => 'ACT003',  'Description' => 'The Third Activity', 'Max_hours' => '10', 'Min_hours' => '6'],
        ]);
    }
}
