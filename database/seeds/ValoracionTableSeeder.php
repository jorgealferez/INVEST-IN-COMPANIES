<?php

use App\Valoracion;
use Illuminate\Database\Seeder;

class ValoracionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $valoracion = new Valoracion();
        $valoracion->name = 'Pobre';
        $valoracion->save();

        $valoracion = new Valoracion();
        $valoracion->name = 'Regular';
        $valoracion->save();

        $valoracion = new Valoracion();
        $valoracion->name = 'Buena';
        $valoracion->save();

        $valoracion = new Valoracion();
        $valoracion->name = 'Muy Buena';
        $valoracion->save();

        $valoracion = new Valoracion();
        $valoracion->name = 'Excelente';
        $valoracion->save();

       
    }
}
