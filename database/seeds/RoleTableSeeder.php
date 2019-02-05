<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = new Role();
        $role->name = 'Admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'Asesor';
        $role->description = 'Responsable de asociación';
        $role->save();

        $role = new Role();
        $role->name = 'Gestor';
        $role->description = 'Gestor de publicaciones';
        $role->save();

        $role = new Role();
        $role->name = 'User';
        $role->description = 'Inversores registrados';
        $role->save();
    }
}
