<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipFirma;


class TipoFirmasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tfirma1=new TipFirma();
        $tfirma1-> tipo='Electronica';
        $tfirma1->save();

        $tfirma2=new TipFirma();
        $tfirma2-> tipo='DNIe';
        $tfirma2->save();

        //
    }
}
