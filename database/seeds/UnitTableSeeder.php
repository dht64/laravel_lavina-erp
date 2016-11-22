<?php

use Illuminate\Database\Seeder;
use App\Unit;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $unit1 = new Unit();
        $unit1->name = "pack";
        $unit1->equi = 24;
        $unit1->save();

        $unit2 = new Unit();
        $unit2->name = "hod";
        $unit2->equi = 1;
        $unit2->save();

        $unit3 = new Unit();
        $unit3->name = "lot";
        $unit3->equi = 40;
        $unit3->save();
    }
}
