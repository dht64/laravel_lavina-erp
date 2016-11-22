<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = new Role();
        $role1->name = "admin";
        $role1->save();

        $role2 = new Role();
        $role2->name = "manager";
        $role2->save();

        $role3 = new Role();
        $role3->name = "business";
        $role3->save();

        $role4 = new Role();
        $role4->name = "employee";
        $role4->save();

        $role5 = new Role();
        $role5->name = "unknown";
        $role5->save();
    }
}
