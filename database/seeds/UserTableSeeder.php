<?php

use App\Role;
use App\User;
use App\Oferta;
use App\Asociacion;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $role_admin = Role::where('name', 'Admin')->first();
        $user_admin = new User();
        $user_admin->name = 'Admin';
        $user_admin->surname = 'Apellidos Apellidos';
        $user_admin->phone = '666666666';
        $user_admin->LOPD = true;
        $user_admin->active = true;
        $user_admin->email = 'admin@admin.com';
        $user_admin->password = bcrypt('secret');
        $user_admin->email_verified_at = now();
        $user_admin->save();
        $user_admin->roles()->save($role_admin);


    	foreach (range(1,5) as $index) {
            $role_asesor = Role::where('name', 'Asesor')->first();
            $asociacion =   Asociacion::get()->random() ;
            $user_asesor = new User();
            $user_asesor->name = 'Asesor '.$index;
            $user_asesor->surname = 'Apellidos Apellidos';
            $user_asesor->phone = '666666666';
            $user_asesor->LOPD = true;
            $user_asesor->active = true;
            $user_asesor->email = 'asesor'.$index.'@asesor.com';
            $user_asesor->password = bcrypt('secret');
            $user_asesor->email_verified_at = now();
            $user_asesor->save();
            $user_asesor->roles()->save($role_asesor);
            $user_asesor->asociaciones()->save($asociacion);



                $role_gestor = Role::where('name', 'Gestor')->first();
                $user_gestor = new User();
                $user_gestor->name = 'Gestor '.$index;
                $user_gestor->surname = 'Apellidos Apellidos';
                $user_gestor->phone = '666666666';
                $user_gestor->LOPD = true;
                $user_gestor->active = true;
                $user_gestor->email = 'gestor'.$index.'@gestor.com';
                $user_gestor->password = bcrypt('secret');
                $user_gestor->email_verified_at = now();
                $user_gestor->save();
                $user_gestor->roles()->save($role_gestor);
                $user_gestor->asociaciones()->save($asociacion);


        }


        $faker = Faker::create('es_ES');
    	foreach (range(1,10) as $index) {
            $role_user = Role::where('name', 'Inversor')->first();
            $user = new User();
            $user->name = $faker->firstName;
            $user->surname = $faker->lastName;
            $user->phone = $faker->phoneNumber;
            $user->LOPD = true;
            $user->active = true;
            $user->email = $faker->email;
            $user->email_verified_at = now();
            $user->password = bcrypt('secret');
            $user->save();
            $user->roles()->save($role_user);
	    }
    }
}
