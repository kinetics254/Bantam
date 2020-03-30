<?php

use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\LeaveType::insert(
            [
                ['Code' => 'ANNUAL','Description' => 'Annual Leave','Days' => '21.00','InActive' => '0','Accrue_Days' => '1','Unlimited_Days' => '0','Gender' => 'both','Balance' => 'Carry_Forward','Inclusive_of_Holidays' => '0','Max_Carry_Forward_Days' => '0.00','Off_Holidays_Days_Leave' => '0'],
                ['Code' => 'COMPSS','Description' => 'Compassionate Leave','Days' => '3.00','InActive' => '0','Accrue_Days' => '0','Unlimited_Days' => '0','Gender' => 'both','Balance' => 'Ignore','Inclusive_of_Holidays' => '0','Max_Carry_Forward_Days' => '0.00','Off_Holidays_Days_Leave' => '0'],
                ['Code' => 'MATERNITY','Description' => 'Maternity Leave','Days' => '90.00','InActive' => '0','Accrue_Days' => '0','Unlimited_Days' => '0','Gender' => 'Female','Balance' => 'Ignore','Inclusive_of_Holidays' => '1','Max_Carry_Forward_Days' => '0.00','Off_Holidays_Days_Leave' => '0'],
                ['Code' => 'OFFDAY','Description' => 'Off Days','Days' => '0.00','InActive' => '0','Accrue_Days' => '0','Unlimited_Days' => '0','Gender' => 'both','Balance' => 'Ignore','Inclusive_of_Holidays' => '0','Max_Carry_Forward_Days' => '0.00','Off_Holidays_Days_Leave' => '1'],
                ['Code' => 'PATERNITY','Description' => 'Paternity Leave','Days' => '10.00','InActive' => '0','Accrue_Days' => '0','Unlimited_Days' => '0','Gender' => 'Male','Balance' => 'Ignore','Inclusive_of_Holidays' => '1','Max_Carry_Forward_Days' => '0.00','Off_Holidays_Days_Leave' => '0'],
                ['Code' => 'SICK','Description' => 'Sick Leave','Days' => '7.00','InActive' => '0','Accrue_Days' => '1','Unlimited_Days' => '0','Gender' => 'both','Balance' => 'Ignore','Inclusive_of_Holidays' => '0','Max_Carry_Forward_Days' => '0.00','Off_Holidays_Days_Leave' => '0']
            ]
        );

    }
}
