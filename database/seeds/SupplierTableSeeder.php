<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $supplier1 = new Supplier();
        $supplier1->name = "Supplier 1";
        $supplier1->address1 = "Supplier 1 Address";
        $supplier1->phone = "12345678";
        $supplier1->save();

        $supplier2 = new Supplier();
        $supplier2->name = "Supplier 2";
        $supplier2->address1 = "Supplier 2 Address";
        $supplier2->phone = "23456789";
        $supplier2->save();
    }
}
