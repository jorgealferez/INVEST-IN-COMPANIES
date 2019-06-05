<?php

use App\Ofertatipo;
use Illuminate\Database\Seeder;

class OfertatipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $forma = new Ofertatipo();
        $forma->name="Venta";
        $forma->save();


        $forma = new Ofertatipo();
        $forma->name="Ampliación de capital";
        $forma->save();


    }
}
