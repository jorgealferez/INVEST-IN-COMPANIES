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
        $sector->name = 'Automoción y transporte';
        $sector->save();

       
        $sector = new Sector();
        $sector->name = 'Químico, farmacéutico y sanitario';
        $sector->save();
        
        $sector = new Sector();
        $sector->name = 'Textil, calzado y confección';
        $sector->save();
        
        $sector = new Sector();
        $sector->name = 'Construcción';
        $sector->save();
        
        $sector = new Sector();
        $sector->name = 'Alimentación y restauración';
        $sector->save();
        
        $sector = new Sector();
        $sector->name = 'Siderurgia, metalurgia, fabricación y comercialización de maquinaria';
        $sector->save();
        
        $sector = new Sector();
        $sector->name = 'Servicios a empresas';
        $sector->save();
        
        $sector = new Sector();
        $sector->name = 'Papel, cartón, artes gráficas, edición';
        $sector->save();
        
        $sector = new Sector();
        $sector->name = 'Servicios recreativos, culturales, ocio';
        $sector->save();
        
       
    }
}
