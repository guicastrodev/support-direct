<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $senhaPadrao = Hash::make('tcc@2023');

        $usuarios =[['name' => 'Isabela Rodrigues','email' => 'isabela.rodrigues@supportdirect.com.br','password' => $senhaPadrao],
        ['name' => 'Pedro Souza','email' => 'pedro.souza@supportdirect.com.br','password' => $senhaPadrao],
        ['name' => 'Beatriz Lima','email' => 'beatriz.lima@supportdirect.com.br','password' => $senhaPadrao]];

        foreach ($usuarios as $usuario) {
            User::create($usuario);
        }
    }
}
