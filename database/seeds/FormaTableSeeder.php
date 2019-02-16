<?php

use App\Forma;
use Illuminate\Database\Seeder;

class FormaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $forma = new Forma();
        $forma->name="Autónomo";
        $forma->save();


        $forma = new Forma();
        $forma->name="Comunidad de Bienes";
        $forma->save();

        $forma = new Forma();
        $forma->name="Sociedad Civil";
        $forma->save();

        $forma = new Forma();
        $forma->name="Sociedad Colectiva";
        $forma->save();

        $forma = new Forma();
        $forma->name="Sociedad de Responsabilidad Limitada";
        $forma->save();

        $forma = new Forma();
        $forma->name="Sociedad Anónima";
        $forma->save();

        $forma = new Forma();
        $forma->name="Sociedad Colectiva";
        $forma->save();

        $forma = new Forma();
        $forma->name="Entidades de Capital-Riesgo";
        $forma->save();

        $forma = new Forma();
        $forma->name="Agrupación de Interés Económico";
        $forma->save();

    }
}
