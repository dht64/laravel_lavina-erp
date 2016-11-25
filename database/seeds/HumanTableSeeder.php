<?php

use Illuminate\Database\Seeder;

use App\Human;

class HumanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $human1 = new Human();
        $human1->name = "Admin";
        $human1->job = "admin";
        $human1->start_day = "2016-10-1";
        $human1->birth = "1980-1-1";
        $human1->gender = "male";
        $human1->address1 = "Admin address";
        $human1->phone = "090000000";
        $human1->idnum = "123456789";
        $human1->save();

        $human2 = new Human();
        $human2->name = "Business";
        $human2->job = "business";
        $human2->start_day = "2016-10-1";
        $human2->birth = "1980-2-2";
        $human2->gender = "female";
        $human2->address1 = "Business address";
        $human2->phone = "090000001";
        $human2->idnum = "123456780";
        $human2->save();

        $human3 = new Human();
        $human3->name = "Employee";
        $human3->job = "employee";
        $human3->start_day = "2016-10-1";
        $human3->birth = "1980-2-2";
        $human3->gender = "male";
        $human3->address1 = "Employee address";
        $human3->phone = "090000002";
        $human3->idnum = "123456781";
        $human3->save();

        $human4 = new Human();
        $human4->name = "Inventory Manager";
        $human4->job = "manager";
        $human4->start_day = "2016-10-1";
        $human4->birth = "1980-2-2";
        $human4->gender = "male";
        $human4->address1 = "Manager address";
        $human4->phone = "090000003";
        $human4->idnum = "123456782";
        $human4->save();
    }
}
