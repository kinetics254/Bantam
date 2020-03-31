<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//         $this->call(UserSeeder::class);
//         $this->call(EmployeeSeeder::class);
//         $this->call(LeaveTypeSeeder::class);
//         $this->call(ProjectSeed::class);
         $this->call(ActivitySeed::class);
         $this->call(TaskSeed::class);
//         $this->call(LocationSeed::class);
    }
}
