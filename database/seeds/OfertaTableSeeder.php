<?php

use App\User;
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
    	// foreach (range(1,6) as $index) {
            $oferta = new Oferta();
            $oferta->asociacion_id = 1;
            $oferta->user_id = 3;
            $oferta->forma_id = random_int(1,9);
            $oferta->provincia_id = random_int(1,52);
            $oferta->sector_id = random_int(1,9);
            $oferta->valoracion_id = random_int(1,4);
            $oferta->name = 'Oferta 1';
            $oferta->cif = $faker->ean8;
            $oferta->contact = $faker->firstName;
            $oferta->contactSurname = $faker->lastName;
            $oferta->contactPhone = $faker->phoneNumber;
            $oferta->contactEmail = $faker->email;
            $oferta->address = $faker->address;
            $oferta->municipio = $faker->city;
            $oferta->empleados =  random_int(1,100);
            $oferta->web = $faker->freeEmailDomain;
            $oferta->explotacion1 = $faker->word;
            $oferta->explotacion2 = $faker->word;
            $oferta->explotacion3 = $faker->word;
            $oferta->endeudamiento = $faker->buildingNumber;
            $oferta->socios = $faker->numberBetween(1,5);
            $oferta->motivo = $faker->text;
            $oferta->año = $faker->year;
            $oferta->local = $faker->boolean;
            $oferta->phone =  $faker->phoneNumber;
            $oferta->active = 1;
            $oferta->save();
            for ($i=1; $i < 3; $i++) {

                $oferta->inversores()->save(User::find($i+9));
            }


            $oferta = new Oferta();
            $oferta->asociacion_id = 2;
            $oferta->user_id = 6;
            $oferta->forma_id = random_int(1,9);
            $oferta->provincia_id = random_int(1,52);
            $oferta->sector_id = random_int(1,9);
            $oferta->valoracion_id = random_int(1,4);
            $oferta->name = 'Oferta 2';
            $oferta->cif = $faker->ean8;
            $oferta->contact = $faker->firstName;
            $oferta->contactSurname = $faker->lastName;
            $oferta->contactPhone = $faker->phoneNumber;
            $oferta->contactEmail = $faker->email;
            $oferta->address = $faker->address;
            $oferta->municipio = $faker->city;
            $oferta->empleados =  random_int(1,100);
            $oferta->web = $faker->freeEmailDomain;
            $oferta->explotacion1 = $faker->word;
            $oferta->explotacion2 = $faker->word;
            $oferta->explotacion3 = $faker->word;
            $oferta->endeudamiento = $faker->buildingNumber;
            $oferta->socios = $faker->numberBetween(1,5);
            $oferta->motivo = $faker->text;
            $oferta->año = $faker->year;
            $oferta->local = $faker->boolean;
            $oferta->phone =  $faker->phoneNumber;
            $oferta->active = 1;
            $oferta->save();
            for ($i=1; $i < 2; $i++) {

                $oferta->inversores()->save(User::find($i+13));
            }
	    // }
    }
}
