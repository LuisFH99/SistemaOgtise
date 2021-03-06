<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use App\Models\MotivoSolicitud;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // \App\Models\User::factory(10)->create();
       $this->call(RoleSeeder::class);
       User::create([
            'name'=>'OGTISE',
            'email'=>'ogtise_mail@unasam.edu.pe',
            'password'=>bcrypt('Ogtise1234')
        ])->assignRole('Admin');
        Persona::create([
            'DNI'           =>'31256980',
            'nombres'       =>'Oficina General de',
            'apellPat'      =>'Tecnologías de Información,',
            'apellMat'      =>'Sistemas y Estadística',
            'fechNacimiento'=>'2009-01-01',
            'correo'        =>'ogtise_mail@unasam.edu.pe',
            'telefono'      =>'987654321',
            'estado'        =>1
        ]);   
        //  User::create([
        //     'name'=>'David Maturana',
        //     'email'=>'davis@gmail.com',
        //     'password'=>bcrypt('1234')
        // ])->assignRole('Admin');
        // User::create([
        //     'name'=>'Luis Factor',
        //     'email'=>'luis@gmail.com',
        //     'password'=>bcrypt('1234')
        // ])->assignRole('Admin');
        // User::create([
        //     'name'=>'Thalia Herrera',
        //     'email'=>'thalia09h@gmail.com',
        //     'password'=>bcrypt('1234')
        // ])->assignRole('Admin');
        // User::create([
        //     'name'=>'Jescenia Melgarejo',
        //     'email'=>'jesmelgarejo46@gmail.com',
        //     'password'=>bcrypt('1234')
        // ])->assignRole('Admin');
        
        //User::factory(9)->create();

        $this->call(MotivoSeeder::class);
        $this->call(FacultadSeeder::class);
        $this->call(DepAcademicoSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(CondicionSeeder::class);
        $this->call(DedicacionSeeder::class);
        $this->call(SemanaSeeder::class);
        $this->call(TipoFirmasSeeder::class);
        $this->call(EstadoSoliSeeder::class);
        $this->call(EstadoasisSeeder::class);
         





    }
}
