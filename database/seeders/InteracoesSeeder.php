<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interacao;
use App\Models\Chamado;
use Faker\Factory as Faker;

class InteracoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $descricoes = [
            '',
            'Identificado um erro ao tentar iniciar o sistema. O sistema trava durante a inicialização e exibe uma mensagem de erro.',
            'Usuário relatou dificuldades em se conectar à rede da empresa. Ele mencionou que recebeu mensagens de erro de conexão.',
            'Os usuários estão enfrentando problemas frequentes de travamento do aplicativo. As telas congelam e os usuários precisam reiniciar o aplicativo.',
            'Usuário não consegue acessar a Intranet da empresa. Ele relata que a página não carrega corretamente e recebe erros de página não encontrada.',
            'Usuário esqueceu a senha de acesso à sua conta. Ele precisa de assistência para redefinir a senha e recuperar o acesso à sua conta.',
            'Os navegadores dos usuários não conseguem abrir nenhum site. Eles relatam que as páginas permanecem em branco.',
            'Usuário está tendo problemas para imprimir documentos em sua impressora sem fio. Os documentos não estão sendo enviados para a impressora.',
            'É necessário realizar uma atualização de software no sistema. O usuário solicitou essa atualização para corrigir problemas conhecidos.',
            'Usuário está tendo dificuldades em acessar seu e-mail. Ele relata que suas mensagens não estão sendo enviadas ou recebidas corretamente.',
            'Os computadores dos usuários estão operando lentamente e não respondendo. Os usuários enfrentam atrasos ao realizar tarefas simples.',
            'Erro ao tentar instalar o antivírus recomendado. O usuário relata que a instalação falha no meio do processo.',
            'Problema com o backup de dados do sistema. O usuário não conseguiu fazer o backup de seus arquivos importantes.',
            'Usuário está recebendo uma tela azul com uma mensagem de erro no Windows. A mensagem de erro é desconhecida.',
            'Usuário relata problemas de áudio em seu computador. O som está distorcido e inaudível.',
            'Perda de conexão VPN durante uma sessão de trabalho remoto. O usuário foi desconectado da rede corporativa.',
            'Usuário está tendo problemas ao imprimir documentos. Os documentos estão saindo com qualidade ruim ou não estão sendo impressos.',
            'Usuário mencionou que um aplicativo específico não está respondendo. Ele não consegue executar tarefas no aplicativo.',
            'Usuário não consegue acessar pastas compartilhadas na rede. Ele relata mensagens de erro de permissão.',
            'Erro ao tentar conectar-se ao banco de dados da empresa. A aplicação não consegue acessar os dados.',
            'Usuário enfrenta problemas com a configuração do firewall pessoal. Ele não consegue autorizar determinados aplicativos.',
            'E-mail não está sendo entregue à caixa de entrada do usuário. Ele relata que não recebeu mensagens recentes.',
            'Usuário relata lentidão na velocidade de internet. Ele está enfrentando atrasos ao abrir páginas da web.',
            'Erro de autenticação ao tentar acessar o servidor da empresa. O usuário não consegue fazer login.',
            'Problema com o cabo de rede na estação de trabalho do usuário. O cabo está danificado e precisa ser substituído.',
            'Usuário está usando um software desatualizado. A versão atual do software não é compatível com sua tarefa.',
            'Usuário relata problemas com a câmera embutida no laptop. A câmera não funciona corretamente durante videoconferências.',
            'Erro de resolução de DNS no servidor da empresa. O servidor não está conseguindo traduzir nomes de domínio em endereços IP.',
            'Problema com a instalação de drivers de hardware. O usuário não conseguiu instalar os drivers corretos para seu dispositivo.',
            'Dispositivo USB não está sendo reconhecido pelo sistema. O dispositivo não aparece quando conectado à porta USB.',
            'Usuário enfrenta problemas de conectividade Wi-Fi. Ele não consegue se conectar à rede sem fio da empresa.'
        ];
                
        $faker = Faker::create('pt_BR');
        foreach (range(1, 30) as $index) {
            $chamado = Chamado::find($index + 1000000);
            if ($chamado){
            Interacao::create([
                'descricao' => $descricoes[$index],
                'datahora' => $chamado->created_at,
                'usuarioID' => $chamado->requerenteID,
                'chamadoID' => $chamado->id, 
                'created_at' => $chamado->created_at,
                'updated_at' => $chamado->updated_at,
            ]);
        }
        }
    }
}
