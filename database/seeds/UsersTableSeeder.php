<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user1 = new User();
        $user1->name = "Admin";
        $user1->username = "admin";
        $user1->email = "admin@email.com";
        $user1->password = bcrypt('123456');
        $user1->role_id = 1;
        $user1->is_active = 1;
        $user1->save();

        $user2 = new User();
        $user2->name = "Business";
        $user2->username = "business";
        $user2->email = "business@email.com";
        $user2->password = bcrypt('123456');
        $user2->role_id = 3;
        $user2->is_active = 1;
        $user2->save();

        $user3 = new User();
        $user3->name = "Employee";
        $user3->username = "employee";
        $user3->email = "employee@email.com";
        $user3->password = bcrypt('123456');
        $user3->role_id = 4;
        $user3->is_active = 1;
        $user3->save();

        $user4 = new User();
        $user4->name = "Inventory Manager";
        $user4->username = "manager";
        $user4->email = "manager@email.com";
        $user4->password = bcrypt('123456');
        $user4->role_id = 2;
        $user4->is_active = 1;
        $user4->save();
    }
}
