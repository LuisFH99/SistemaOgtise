<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dedicacion;
class DedicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dedicacion1=new Dedicacion();
        $dedicacion1-> nomDedi='Dedicacacion Exclusiva';
        $dedicacion1->save();

        $dedicacion2=new Dedicacion();
        $dedicacion2-> nomDedi='Tiempo Completo';
        $dedicacion2->save();

        $dedicacion3=new Dedicacion();
        $dedicacion3-> nomDedi='Tiempo Parcial';
        $dedicacion3->save();

                //
    }
}
