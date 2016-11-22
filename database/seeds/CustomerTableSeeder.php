<?php

use Illuminate\Database\Seeder;
use App\Customer; 

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $customer1 = new Customer();
        $customer1->name = "ABC";
        $customer1->tax_num = "123456";
        $customer1->address1 = "123 Street";
        $customer1->phone = "0911111111";
        $customer1->save();

        $customer2 = new Customer();
        $customer2->name = "DEF";
        $customer2->tax_num = "56789";
        $customer2->address1 = "456 Street";
        $customer2->phone = "0922222222";
        $customer2->save();
    }
}
