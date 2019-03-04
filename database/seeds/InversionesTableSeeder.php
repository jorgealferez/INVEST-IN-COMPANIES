<?php

use App\User;
use App\Forma;
use App\Oferta;
use App\Sector;
use App\Inversion;
use App\Poblacion;
use App\Provincia;
use App\Asociacion;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class InversionesTableSeeder extends Seeder
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
                $inversor = User::whereHas('roles', function($q){$q->whereIn('name', ['Inversor']);})->get()->random();
                $oferta = Oferta::get()->random();
                $inversion = new Inversion();
                $inversion->user_id = $inversor->id;
                $inversion->oferta_id = $oferta->id;
                $inversion->estado_id =1;
                $inversion->save();
                // $oferta->inversores()->attach($inversor_id, ['estado_id'=>1]);
            }


    }
}
