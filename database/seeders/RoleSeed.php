<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Super Admin','Gerente de serviços', 'Solicitante'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }

        $admin = Role::where('name', 'Gerente de serviços')->first();
        foreach (Permission::all() as $permission){
            $admin->givePermissionTo($permission->name);
        }

        $requester = Role::where('name', 'Solicitante')->first();
        foreach (['Criar ordens de serviços', 'Visualizar ordens de serviços'] as $permission){
            $requester->givePermissionTo($permission);
        }
    }
}
