<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nombre' => 'Administrador',
            'apellido_paterno' => '-',
            'apellido_materno' => '-',
            'rol' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('1234567890'),
        ]);
    }
}
