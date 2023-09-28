<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perfil;

class PerfisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfis =[['nome' => 'Gestor','acesso' => 'gestor'],
        ['nome' => 'Técnico','acesso' => 'tecnico'],
        ['nome' => 'Cliente','acesso' => 'cliente'],
        ['nome' => 'Administrador','acesso' => 'admin']];

        foreach ($perfis as $perfil) {
            Perfil::create($perfil);
        }
    }
}
