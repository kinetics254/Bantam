<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::insert(
           [
               ['name' => 'Annette Hill','email' => 'ah@cronus-demosite.com','password' => Hash::make('allowme@1')],
               ['name' => 'John Roberts','email' => 'jr@cronus-demosite.com','password' => Hash::make('allowme@1')],
               ['name' => 'Linda Martin','email' => 'lm@cronus-demosite.com','password' => Hash::make('allowme@1')],
               ['name' => 'Mary Dempsey','email' => 'md@cronus-demosite.com','password' => Hash::make('allowme@1')],
               ['name' => 'Mark Hanson','email' => 'mh@cronus-demosite.com','password' => Hash::make('allowme@1')],
               ['name' => 'Peter Saddow','email' => 'ps@cronus-demosite.com','password' => Hash::make('allowme@1')],
               ['name' => 'Richard Lum','email' => 'rl@cronus-demosite.com','password' => Hash::make('allowme@1')],
               ['name' => 'Timothy Sneath','email' => 'ts@cronus-demosite.com','password' => Hash::make('allowme@1')]
           ]
       );

    }
}
