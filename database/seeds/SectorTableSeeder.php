<?php

use App\Sector;
use Illuminate\Database\Seeder;

class SectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sector = new Sector();
        $sector->name = 'Agricultura, ganadería, silvicultura y pesca';
        $sector->save();


        $sector = new Sector();
        $sector->name = 'Industrias extractivas';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Industria manufacturera';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Suministro de energía eléctrica, gas, vapor y aire acondicionado';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Suministro de agua, actividades de saneamiento, gestión de residuos y descontaminación';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Construcción';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Comercio';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Transporte y almacenamiento';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Hostelería';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Información y comunicaciones';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Actividades financieras y de seguros';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Actividades inmobiliarias';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Actividades profesionales, científicas y técnicas';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Actividades administrativas y servicios auxliares';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Administración Pública y defensa; Seguridad Social obligatoria';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Educación';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Actividades sanitarias y de servicios sociales';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Actividades artísticas, recreativas y de entrenimiento';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Otros Servicios';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Actividades de los hogares como empleadores de personal doméstico; actividades de los hogares como productores de bienes y servicios para uso propio';
        $sector->save();

        $sector= new Sector();
        $sector->name = 'Actividades de organizaciones y organismos extraterritoriales';
        $sector->save();



    }
}
