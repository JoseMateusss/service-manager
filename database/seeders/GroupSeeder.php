<?php

namespace Database\Seeders;

use App\Models\GroupPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(['Ordens de serviços', 'Usuários'] as $name){
            GroupPermission::query()->create([
                'name' => $name
            ]);
        }
    }
}
