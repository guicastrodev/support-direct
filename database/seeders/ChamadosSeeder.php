<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chamado;
use Faker\Factory as Faker;

class ChamadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('pt_BR');

        $titulos = [
            '',
            'Erro ao iniciar o sistema',
            'Problema de conexão com a rede',
            'Aplicativo travando constantemente',
            'Problema de acesso à Intranet',
            'Senha de acesso esquecida',
            'Navegador não abre sites',
            'Problema com impressora sem fio',
            'Atualização de software necessária',
            'Problema de acesso ao servidor de e-mail',
            'Máquina lenta e não responsiva',
            'Erro ao instalar o antivírus',
            'Problema com o backup de dados',
            'Tela azul de erro no Windows',
            'Problema de áudio no computador',
            'Perda de conexão VPN',
            'Problema com a impressão de documentos',
            'Aplicativo não responde',
            'Problema de acesso a pastas compartilhadas',
            'Erro ao conectar ao banco de dados',
            'Problema com a configuração do firewall',
            'E-mail não está sendo entregue',
            'Problema de lentidão na internet',
            'Erro de autenticação no servidor',
            'Problema com o cabo de rede',
            'Software desatualizado',
            'Problema com a câmera do laptop',
            'Erro de DNS no servidor',
            'Problema com a instalação de drivers',
            'Dispositivo USB não reconhecido',
            'Problema de conectividade Wi-Fi'
        ];
        $categorias = [ 0, 1, 2, 1, 2, 1, 2, 2, 1, 2, 1, 2, 2, 1, 2, 1, 2, 1, 2, 2, 1, 2, 1, 1, 2, 1, 2, 1, 2, 1, 2 ];        

        $anterior = $faker->dateTimeBetween('-90 days', '-80 days');

        foreach (range(1, 30) as $index) {
            $anterior = $faker->dateTimeBetween($anterior, '-' .(string)(30 - $index).' days'); 
            Chamado::create([
                'id' => $index + 1000000,
                'titulo' => $titulos[$index],
                'status' => $faker->randomElement(['Aberto', 'Em análise', 'Resolvido', 'Cancelado', 'Aguardando Requerente', 'Aguardando Fornecedor']),
                'requerenteID' => $faker->randomElement([3, 11, 13]),
                'tecnicoID' => $faker->randomElement([2,8,9,10,12]),
                'gestorID' => 1,
                'categoriaID' => $categorias[$index],
                'prioridade' => $faker->randomElement(['baixa', 'media', 'alta']),
                'created_at' => $anterior,
                'updated_at' => $anterior,
            ]);
        }
    }
}
