<?php

use App\User;
use App\Forma;
use App\Oferta;
use App\Sector;
use App\Poblacion;
use App\Provincia;
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
            foreach (range(1,10) as $index) {
                $oferta = new Oferta();
                $oferta->user_id = User::whereHas('roles', function($q){$q->whereIn('name', ['Gestor','Asesor']);})->get()->random()->id;

                $oferta->asociacion_id =  User::find($oferta->user_id)->getAsociacionesDelUsario()->first();
                $oferta->forma_id = Forma::inRandomOrder()->first()->id;
                $oferta->provincia_id = Provincia::inRandomOrder()->first()->id;
                $oferta->sector_id = Sector::inRandomOrder()->first()->id;
                $oferta->poblacion_id = Poblacion::inRandomOrder()->first()->id;
                $oferta->name = 'Oferta '.$index;
                $oferta->cif = $faker->ean8;
                $oferta->contact = $faker->firstName;
                $oferta->contactSurname = $faker->lastName;
                $oferta->contactPhone = $faker->phoneNumber;
                $oferta->contactEmail = $faker->email;
                $oferta->address = $faker->address;
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
                $oferta->approved =  random_int(0,1);
                $oferta->save();
            }


    }
}
