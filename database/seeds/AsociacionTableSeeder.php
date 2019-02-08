<?php

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
    	foreach (range(1,10) as $index) {
            $asociacion = new Asociacion();
            $asociacion->name = $faker->company;
            $asociacion->address = $faker->address;
            $asociacion->email = $faker->email;
            $asociacion->phone = $faker->phoneNumber;
            $asociacion->contact = $faker->name;
            $asociacion->contactPhone = $faker->phoneNumber;
            $asociacion->contactEmail = $faker->email;
            $asociacion->active = 1;
            $asociacion->save();
	    }
        
    }
}
