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

        $pessoas =[['nome' => 'Beatriz Lima Barreto','departamentoID' => 1,'disponibilidade' =>true],
        ['nome' => 'Pedro de Souza Albuquerque','departamentoID' => 1,'disponibilidade' =>true],
        ['nome' => 'Isabela Rodrigues Fonseca','disponibilidade' =>true]];

        foreach ($pessoas as $pessoa) {
            Pessoa::create($pessoa);
        }        
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Pessoa::create([
                'nome' => $faker->name,
                'empresa' => $faker->company,
                'endereco' => $faker->address,
                'telefone' => $faker->phoneNumber,
                'cpfcnpj' => $faker->unique()->randomNumber(9) . $faker->unique()->randomNumber(2),
                'especialidade' => $faker->word,
                'disponibilidade' => $faker->boolean(80), // 80% de chance de ser verdadeiro
                'departamentoID' => $faker->numberBetween(1, 5), //5 departamentos definidos
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
