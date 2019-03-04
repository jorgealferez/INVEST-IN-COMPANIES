<?php

use App\Estadoinversor;
use Illuminate\Database\Seeder;

class EstadoinversorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estados =[
        'Nueva',
        'En proceso',
        'Volver a contactar',
        'Esperando respuesta',
        'Finalizado',
        'Rechazado',

        ];

        foreach ($estados as $est) {
            $estado = new Estadoinversor();
            $estado->name=$est;
            $estado->save();
        }
    }
}
