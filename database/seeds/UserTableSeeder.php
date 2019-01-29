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
        $user_admin->email = 'admin@admin.com';
        $user_admin->password = bcrypt('secret');
        $user_admin->email_verified_at = now();
        $user_admin->save();
        $user_admin->roles()->attach($role_admin);

        $role_asociacion = Role::where('name', 'Asociacion')->first();
        $asociacion = Asociacion::where('name', 'Asociacion Prueba')->first();
        $user_asociacion = new User();
        $user_asociacion->name = 'Asociacion';
        $user_asociacion->email = 'asociacion@asociacion.com';
        $user_asociacion->password = bcrypt('secret');
        $user_asociacion->email_verified_at = now();
        $user_asociacion->save();
        $user_asociacion->roles()->attach($role_asociacion);
        $user_asociacion->asociacion()->attach($asociacion);

        $role_gestor = Role::where('name', 'Gestor')->first();
        $user_gestor = new User();
        $user_gestor->name = 'Gestor';
        $user_gestor->email = 'gestor@gestor.com';
        $user_gestor->password = bcrypt('secret');
        $user_gestor->email_verified_at = now();
        $user_gestor->save();
        $user_gestor->roles()->attach($role_gestor);
        $user_gestor->asociacion()->attach($asociacion);


        $role_user = Role::where('name', 'User')->first();
        $user = new User();
        $user->name = 'User';
        $user->email = 'user@user.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
