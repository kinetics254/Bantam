<?php

use Illuminate\Database\Seeder;

class TaskSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Task::insert([
            ['Code' => 'TASK001',  'Description' => 'The First Task'],
            ['Code' => 'TASK002',  'Description' => 'The Second Task'],
            ['Code' => 'TASK003',  'Description' => 'The Third Task']
        ]);
    }
}
