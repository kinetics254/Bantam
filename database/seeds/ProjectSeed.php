<?php

use Illuminate\Database\Seeder;

class ProjectSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Project::insert([
            ['Code' => 'PROJ001', 'Name' => 'Project One', 'Description' => 'The First Project'],
            ['Code' => 'PROJ002', 'Name' => 'Project Two', 'Description' => 'The Second Project'],
            ['Code' => 'PROJ003', 'Name' => 'Project Three', 'Description' => 'The Third Project'],
        ]);
    }
}
