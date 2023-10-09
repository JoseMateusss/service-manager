<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Editar ordens de serviços',
            'Criar ordens de serviços',
            'Excluir ordens de serviços',
            'Visualizar ordens de serviços',
            'Editar usuários',
            'Criar usuários',
            'Excluir usuários',
            'Visualizar usuários'
        ];

        foreach ($permissions as $key => $permission) {
            Permission::create([
                'name' => $permission,
                'group_id' => $key > 3 ? 2 : 1
            ]);
        }
    }
}
