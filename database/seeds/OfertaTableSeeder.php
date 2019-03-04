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
            foreach (range(1,10) as $index) {
                $oferta = new Oferta();
                $oferta->user_id = User::whereHas('roles', function($q){$q->whereIn('name', ['Gestor','Asesor']);})->get()->random()->id;

                $oferta->active = 1;
                $oferta->address = $faker->address;
                $oferta->año = $faker->year;
                $oferta->approved =  random_int(0,1);
                $oferta->asociacion_id =  User::find($oferta->user_id)->getAsociacionesDelUsario()->first();
                $oferta->cif = "A".$faker->ean8;
                $oferta->contact = $faker->firstName;
                $oferta->contactEmail = $faker->email;
                $oferta->contactPhone = "6".$faker->ean8;
                $oferta->contactSurname = $faker->lastName;
                $oferta->descripcion = $faker->text;
                $oferta->empleados =  random_int(1,100);
                $oferta->endeudamiento = $faker->buildingNumber;
                $oferta->explotacion1 = $faker->word;
                $oferta->explotacion2 = $faker->word;
                $oferta->explotacion3 = $faker->word;
                $oferta->forma_id = Forma::inRandomOrder()->first()->id;
                $oferta->local = $faker->boolean;
                $oferta->motivo = $faker->text;
                $oferta->name = 'Oferta '.$index;
                $oferta->provincia_id = Provincia::inRandomOrder()->first()->id;
                $oferta->poblacion_id = Poblacion::where('provincia_id',$oferta->provincia_id )->inRandomOrder()->first()->id;
                $oferta->sector_id = Sector::inRandomOrder()->first()->id;
                $oferta->socios = $faker->numberBetween(1,5);
                $oferta->valoracion = $faker->randomFloat(2,1000,1000000);
                $oferta->web = "www.google.es";


                $oferta->save();
            }


    }
}
