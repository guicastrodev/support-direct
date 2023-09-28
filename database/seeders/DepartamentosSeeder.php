<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
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
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            Departamento::create([
                'nome' => $faker->unique()->word,
                'descricao' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
