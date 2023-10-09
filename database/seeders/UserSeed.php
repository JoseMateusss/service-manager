<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Wilza Dandas',
            'email' => 'wilza@consultoriaeco.com.br',
            'password' => 'consultoriaeco',
        ])->roles()->attach(1);
    }
}
