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
        'requerenteID',
        'tecnicoID',
        'gestorID',
        'categoria',
        'prioridade',
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

    public function requerente()
    {
        return $this->belongsTo(User::class, 'requerenteID');
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnicoID');
    }

    public function gestor()
    {
        return $this->belongsTo(User::class, 'gestorID');
    } 
    
    public function iteracoes()
    {
        return $this->hasMany(Iteracao::class,'chamadoID');
    }    
}
