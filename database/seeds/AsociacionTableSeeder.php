<?php

use App\Asociacion;
use Illuminate\Database\Seeder;

class AsociacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $asociacion = new Asociacion();
        $asociacion->name = 'Asociacion Prueba';
        $asociacion->description = 'Asociación de prueba';
        $asociacion->save();
    }
}
