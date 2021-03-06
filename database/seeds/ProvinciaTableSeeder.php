<?php

use App\Provincia;
use Illuminate\Database\Seeder;

class ProvinciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $provincias =[
        'Álava',
        'Albacete',
        'Alicante',
        'Almería',
        'Ávila',
        'Badajoz',
        'Illes Balears',
        'Barcelona',
        'Burgos',
        'Cáceres',
        'Cádiz',
        'Castellón',
        'Ciudad Real',
        'Córdoba',
        'A Coruña',
        'Cuenca',
        'Girona',
        'Granada',
        'Guadalajara',
        'Guipúzcoa',
        'Huelva',
        'Huesca',
        'Jaén',
        'León',
        'Lleida',
        'La Rioja',
        'Lugo',
        'Madrid',
        'Málaga',
        'Murcia',
        'Navarra',
        'Ourense',
        'Asturias',
        'Palencia',
        'Las Palmas',
        'Pontevedra',
        'Salamanca',
        'Santa Cruz de Tenerife',
        'Cantabria',
        'Segovia',
        'Sevilla',
        'Soria',
        'Tarragona',
        'Teruel',
        'Toledo',
        'Valencia',
        'Valladolid',
        'Vizcaya',
        'Zamora',
        'Zaragoza',
        'Ceuta',
        'Melilla'
        ];

        foreach ($provincias as $prov) {

            $provincia = new Provincia();
            $provincia->name=$prov;
            $provincia->save();
        }


    }
}
