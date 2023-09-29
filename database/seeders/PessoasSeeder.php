<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Pessoa;

class PessoasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');

        foreach (range(1, 13) as $index) {
            $endereco[$index] = $faker->address;
            $telefone[$index] = $faker->cellphoneNumber;
            $cpf[$index] = $faker->cpf();
        }

        $pessoas = [
            ['nome' => 'Beatriz Lima Barreto', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[1], 'telefone' => $telefone[1], 'cpfcnpj' => $cpf[1], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Pedro de Souza Albuquerque', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[2], 'telefone' => $telefone[2], 'cpfcnpj' => $cpf[2], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Isabela Rodrigues Fonseca', 'disponibilidade' => true, 'endereco' => $endereco[3], 'telefone' => $telefone[3], 'cpfcnpj' => $cpf[3], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cristina Lozano Serra', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[4], 'telefone' => $telefone[4], 'cpfcnpj' => $cpf[4], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Marta Patrícia Grego Neto', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[5], 'telefone' => $telefone[5], 'cpfcnpj' => $cpf[5], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Eloá Antonella Caldeira', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[6], 'telefone' => $telefone[6], 'cpfcnpj' => $cpf[6], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Jennifer Teles Velasques', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[7], 'telefone' => $telefone[7], 'cpfcnpj' => $cpf[7], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Otávio Gomes da Rosa Sobrinho', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[8], 'telefone' => $telefone[8], 'cpfcnpj' => $cpf[8], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Rafaela Franciele Zamana', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[9], 'telefone' => $telefone[9], 'cpfcnpj' => $cpf[9], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Yuri Manuel Espinoza', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[10], 'telefone' => $telefone[10], 'cpfcnpj' => $cpf[10], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Thalita Simone Galvão', 'disponibilidade' => true, 'endereco' => $endereco[11], 'telefone' => $telefone[11], 'cpfcnpj' => $cpf[11], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Milena Iasmin Gusmão', 'departamentoID' => 1, 'disponibilidade' => true, 'endereco' => $endereco[12], 'telefone' => $telefone[12], 'cpfcnpj' => $cpf[12], 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Maraisa Vale Santana', 'disponibilidade' => true, 'endereco' => $endereco[13], 'telefone' => $telefone[13], 'cpfcnpj' => $cpf[13], 'created_at' => now(), 'updated_at' => now()]
        ];

        foreach ($pessoas as $pessoa) {
            Pessoa::create($pessoa);
        }
    }
}
