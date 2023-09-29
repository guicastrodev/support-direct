<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamentos = [
            ['nome' => 'TI Sistemas', 'descricao' => 'TI Sistemas', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'TI Infra', 'descricao' => 'Infraestrutura de Tecnologia', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'TE', 'descricao' => 'Tecnologia da Educação', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Financeiro', 'descricao' => 'Departamento Financeiro', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'DP&RH', 'descricao' => 'Departamento Pessoa e Recursos Humanos', 'created_at' => now(), 'updated_at' => now()]                                    
        ];

        foreach ($departamentos as $departamento) {
            Departamento::create($departamento);
        }

    }
}
