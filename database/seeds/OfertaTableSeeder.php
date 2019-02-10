<?php

use App\Oferta;
use App\Asociacion;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class OfertaTableSeeder extends Seeder
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
    	foreach (range(1,10) as $index) {
            $oferta = new Oferta();
            $oferta->name = 'Oferta '.$index;
            $oferta->cif = $faker->ean8;
            $oferta->contact = $faker->firstName;
            $oferta->contactSurname = $faker->lastName;
            $oferta->contactPhone = $faker->phoneNumber;
            $oferta->contactEmail = $faker->email;
            $oferta->address = $faker->address;
            $oferta->web = $faker->freeEmailDomain;
            $oferta->endeudamiento = $faker->buildingNumber;
            $oferta->socios = $faker->numberBetween(1,5);
            $oferta->motivo = $faker->text;
            $oferta->año = $faker->year;
            $oferta->valoracion = $faker->randomDigit;
            $oferta->local = $faker->boolean;
            $oferta->phone =  $faker->phoneNumber;
            $oferta->active = 1;
            $oferta->save();
	    }
    }
}
