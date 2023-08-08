<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    // Relaciona a última atualização em horas ou dias
    public function ultimaAtualizacao()
    {
        $agora = now();
        $ultimaAtualizacao = $this->updated_at;

        if ($ultimaAtualizacao) {
            $diferenca = $agora->diff($ultimaAtualizacao);
            if ($diferenca->d > 0) {
                return $diferenca->d . ' dias atrás';
            } elseif ($diferenca->h > 0) {
                return $diferenca->h . ' horas atrás';
            } else {
                return 'Menos de uma hora atrás';
            }
        } else {
            return 'Nunca atualizado';
        }
    }
}
