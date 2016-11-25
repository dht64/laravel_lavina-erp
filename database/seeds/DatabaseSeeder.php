<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(MaterialTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(HumanTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LeaveTableSeeder::class);
    }
}
