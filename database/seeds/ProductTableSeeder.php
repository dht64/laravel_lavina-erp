<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product = new Product();
        $product->name = "350ml Bottle";
        $product->material_id = 1;
        $product->cost = 5;
        $product->vat_rate = 5;
        $product->unit_id = 1;
        $product->save();

        $product2 = new Product();
        $product2->name = "550ml Bottle";
        $product2->material_id = 2;
        $product2->cost = 6;
        $product2->vat_rate = 5;
        $product2->unit_id = 1;
        $product2->save();

        $product3 = new Product();
        $product3->name = "20l Hod";
        $product3->material_id = 3;
        $product3->cost = 1;
        $product3->vat_rate = 5;
        $product3->unit_id = 2;
        $product3->save();
    }
}
