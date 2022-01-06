<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria1=new Categoria();
        $categoria1-> nomCat='Principal';
        $categoria1->save();

        $categoria2=new Categoria();
        $categoria2-> nomCat='Asociado';
        $categoria2->save();

        $categoria3=new Categoria();
        $categoria3-> nomCat='Auxiliar';
        $categoria3->save();
        


        //
    }
}
