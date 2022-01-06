<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condicion;

class CondicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condicion1=new Condicion();
        $condicion1-> nomCondi='Contratado';
        $condicion1->save();

        $condicion2=new Condicion();
        $condicion2-> nomCondi='Nombrado';
        $condicion2->save();
        //
    }
}
