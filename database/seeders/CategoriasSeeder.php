<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomes = [
            '',
            'Redes',
            'Impressoras',
            'Segurança de Dados',
            'Sistemas Operacionais',
            'Hardware',
            'Software',
            'Conectividade',
            'E-mail',
            'Backup e Recuperação',
            'Suporte Técnico',
            'Internet',
            'Firewall',
            'VPN',
            'Autenticação',
            'Manutenção de Equipamentos'
        ];

        $descricoes = [
            '',
            'Gerenciamento de redes e conectividade.',
            'Manutenção e suporte para impressoras e scanners.',
            'Proteção de dados e segurança da informação.',
            'Gerenciamento de sistemas operacionais e plataformas.',
            'Manutenção e suporte para hardware de TI.',
            'Manutenção e suporte para software e aplicativos.',
            'Configuração e solução de problemas de conectividade.',
            'Gerenciamento de e-mails e comunicações corporativas.',
            'Backup de dados e recuperação de desastres.',
            'Assistência técnica geral para TI.',
            'Problemas de conexão com a internet.',
            'Configuração e gerenciamento de firewalls.',
            'Redes privadas virtuais para acesso seguro.',
            'Problemas de autenticação e controle de acesso.',
            'Manutenção e reparo de equipamentos de TI.'
        ];        

        $departamentos = [0, 1, 2, 1, 2, 1, 2, 2, 1, 2, 1, 2, 2, 1, 2, 1 ];

        foreach (range(1, 15) as $index) {
            Categoria::create([
                'nome' => $nomes[$index],
                'descricao' => $descricoes[$index],
                'departamentoID' =>  $departamentos[$index],
            ]);
        }
    }
}
