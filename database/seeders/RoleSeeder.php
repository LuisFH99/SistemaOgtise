<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Docente']);
        $role3 = Role::create(['name' => 'Dpto. Academico']);
        $role4 = Role::create(['name' => 'Decano']);
        $role5 = Role::create(['name' => 'URyC']);
        $role6 = Role::create(['name' => 'Director RRHH']); 

        Permission::create(['name'=>'admin.home'])->syncRoles([$role1,$role2,$role3,$role4,$role5,$role6]);

        Permission::create(['name'=>'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.edit'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.update'])->syncRoles([$role1]);

        Permission::create(['name'=>'licencia'])->syncRoles([$role2]);
        Permission::create(['name'=>'asistencia.Entrada'])->syncRoles([$role2]);
        Permission::create(['name'=>'asistencia.Salida'])->syncRoles([$role2]);

        Permission::create(['name'=>'valida.Salida'])->syncRoles([$role3]);
        Permission::create(['name'=>'valida.licencia'])->syncRoles([$role3]);
        Permission::create(['name'=>'gestion.docente'])->syncRoles([$role1,$role3,$role5]);

        Permission::create(['name'=>'valida.licencia1'])->syncRoles([$role4]);

        Permission::create(['name'=>'valida.licencia2'])->syncRoles([$role5]);
        Permission::create(['name'=>'reportes.parteDiario'])->syncRoles([$role1,$role5]);

        Permission::create(['name'=>'valida.licencia3'])->syncRoles([$role6]);
        Permission::create(['name'=>'valida.licencia.general'])->syncRoles([$role3,$role4,$role5,$role6]);
    }
}
