<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name'=>'David Maturana',
            'email'=>'davi1905m@gmail.com',
            'password'=>bcrypt('1234')
        ])->assignRole('Admin');
        User::create([
            'name'=>'Luis Factor',
            'email'=>'luis@gmail.com',
            'password'=>bcrypt('1234')
        ])->assignRole('Admin');
        User::create([
            'name'=>'Thalia Herrera',
            'email'=>'thalia09h@gmail.com',
            'password'=>bcrypt('1234')
        ])->assignRole('Admin');
        
        User::factory(9)->create();
    }
}
