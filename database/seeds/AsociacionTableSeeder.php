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
        $asociacion->name = 'CEPYME';
        $asociacion->address = 'Calle luna';
        $asociacion->email = 'info@cepyme.es';
        $asociacion->phone = '666 66 66 66';
        $asociacion->active = 1;
        $asociacion->save();
    }
}
