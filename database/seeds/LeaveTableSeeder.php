<?php

use Illuminate\Database\Seeder;

use App\Leave;

class LeaveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leave1 = new Leave();
        $leave1->human_id = 1;
        $leave1->annual_leave = 12;
        $leave1->avai_annual_leave = 12;
        $leave1->unpaid_leave = 0;
        $leave1->save();

        $leave2 = new Leave();
        $leave2->human_id = 2;
        $leave2->annual_leave = 12;
        $leave2->avai_annual_leave = 12;
        $leave2->unpaid_leave = 0;
        $leave2->save();

        $leave3 = new Leave();
        $leave3->human_id = 3;
        $leave3->annual_leave = 12;
        $leave3->avai_annual_leave = 12;
        $leave3->unpaid_leave = 0;
        $leave3->save();

        $leave4 = new Leave();
        $leave4->human_id = 4;
        $leave4->annual_leave = 12;
        $leave4->avai_annual_leave = 12;
        $leave4->unpaid_leave = 0;
        $leave4->save();
    }
}
