<?php

use Illuminate\Database\Seeder;
use App\Material;

class MaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $material1 = new Material();
        $material1->name = "350ml Bottle";
        $material1->cost = 1.1;
        $material1->unit_id = 3;
        $material1->save();

        $material2 = new Material();
        $material2->name = "550ml Bottle";
        $material2->cost = 1.5;
        $material2->unit_id = 3;
        $material2->save();

        $material3 = new Material();
        $material3->name = "20l Hod";
        $material3->cost = 0.2;
        $material3->unit_id = 2;
        $material3->save();
    }
}
