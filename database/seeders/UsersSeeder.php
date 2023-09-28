<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $senhaPadrao = Hash::make("Tcc@2023");

        $usuarios =[['pessoaID' => 1,'perfilID' => 1,'name' => 'Beatriz Lima','email' => 'gestor@castrodev.com.br','password' => Hash::make("Tcc@2023")],
        ['pessoaID' => 2,'perfilID' => 2,'name' => 'Pedro Souza','email' => 'tecnico@castrodev.com.br','password' => Hash::make("Tcc@2023")],
        ['pessoaID' => 3,'perfilID' => 3,'name' => 'Isabela Rodrigues','email' => 'cliente@castrodev.com.br','password' => Hash::make("Tcc@2023")]];

        foreach ($usuarios as $usuario) {
            User::create($usuario);
        }
    }
}
