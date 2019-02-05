<?php

use App\Role;
use App\User;
use App\Asociacion;
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
        $user_admin->phone = '666 66 66 66';
        $user_admin->address = 'Calle Luna 1ºC';
        $user_admin->LOPD = true;
        $user_admin->active = true;
        $user_admin->email = 'admin@admin.com';
        $user_admin->password = bcrypt('secret');
        $user_admin->email_verified_at = now();
        $user_admin->save();
        $user_admin->roles()->attach($role_admin);

        $role_asesor = Role::where('name', 'Asesor')->first();
        $asociacion = Asociacion::where('id', '1')->first();
        $user_asesor = new User();
        $user_asesor->name = 'Asesor 1';
        $user_asesor->surname = 'Apellidos Apellidos';
        $user_asesor->phone = '666 66 66 66';
        $user_asesor->address = 'Calle Luna 1ºC';
        $user_asesor->LOPD = true;
        $user_asesor->active = true;
        $user_asesor->email = 'asesor@asesor.com';
        $user_asesor->password = bcrypt('secret');
        $user_asesor->email_verified_at = now();
        $user_asesor->save();
        $user_asesor->roles()->attach($role_asesor);
        $user_asesor->asociacion()->attach($asociacion);

        $role_gestor = Role::where('name', 'Gestor')->first();
        $user_gestor = new User();
        $user_gestor->name = 'Gestor 1';
        $user_gestor->surname = 'Apellidos Apellidos';
        $user_gestor->phone = '666 66 66 66';
        $user_gestor->address = 'Calle Luna 1ºC';
        $user_gestor->LOPD = true;
        $user_gestor->active = true;
        $user_gestor->email = 'gestor@gestor.com';
        $user_gestor->password = bcrypt('secret');
        $user_gestor->email_verified_at = now();
        $user_gestor->save();
        $user_gestor->roles()->attach($role_gestor);
        $user_gestor->asociacion()->attach($asociacion);


        $role_user = Role::where('name', 'User')->first();
        $user = new User();
        $user->name = 'User 1';
        $user->surname = 'Apellidos Apellidos';
        $user->phone = '666 66 66 66';
        $user->address = 'Calle Luna 1ºC';
        $user->LOPD = true;
        $user->active = true;
        $user->email = 'user@user.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
