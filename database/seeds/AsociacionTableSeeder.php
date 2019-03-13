<?php

use App\Oferta;
use App\Asociacion;

use Faker\Factory as Faker;
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
        $faker = Faker::create('es_ES');
    	foreach (range(1,5) as $index) {
            $asociacion = new Asociacion();
            $asociacion->name = 'Asociacion '.$index;
            $asociacion->address = $faker->address;
            $asociacion->email = $faker->email;
            $asociacion->phone =  "9".$faker->ean8;
            $asociacion->contact = $faker->Firstname;
            $asociacion->contactSurname = $faker->lastName;
            $asociacion->contactPhone =  "6".$faker->ean8;
            $asociacion->contactEmail = $faker->email;
            $asociacion->active = 1;
            $asociacion->save();

	    }

    }
}
