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

        $usuarios =[['pessoaID' => 1,'perfilID' => 1,'name' => 'Beatriz Lima','email' => 'gestor@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 2,'perfilID' => 2,'name' => 'Pedro Souza','email' => 'tecnico@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 3,'perfilID' => 3,'name' => 'Isabela Rodrigues','email' => 'cliente@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 4,'perfilID' => 1,'name' => 'Cristina Lozano','email' => 'cristina.lozano@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 5,'perfilID' => 1,'name' => 'Marta Grego','email' => 'marta.grego@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 6,'perfilID' => 1,'name' => 'Eloá Antonella','email' => 'eloa.antonella@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 7,'perfilID' => 1,'name' => 'Jennifer Teles','email' => 'jennifer.teles@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 8,'perfilID' => 2,'name' => 'Otávio Gomes','email' => 'otavio.gomes@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 9,'perfilID' => 2,'name' => 'Rafaela Franciele','email' => 'rafaela.franciele@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 10,'perfilID' => 2,'name' => 'Yuri Manuel','email' => 'yuri.manuel@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 11,'perfilID' => 3,'name' => 'Thalita Simone','email' => 'thalita.simone@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 12,'perfilID' => 2,'name' => 'Milena Iasmin','email' => 'milena.iasmin@castrodev.com.br','password' => $senhaPadrao],
        ['pessoaID' => 13,'perfilID' => 3,'name' => 'Maraisa Vale','email' => 'maraisa.vale@castrodev.com.br','password' => $senhaPadrao]
    ];

        foreach ($usuarios as $usuario) {
            User::create($usuario);
        }
    }
}
