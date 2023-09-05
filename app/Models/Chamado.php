<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    use HasFactory;

    protected $table = 'chamados';    

    protected $fillable = [
        'titulo',
        'status',
        'requerenteID',
        'tecnicoID',
        'gestorID',
        'categoriaID',
        'prioridade',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ];

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

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'categoriaID');
    }  
    
    public function iteracoes()
    {
        return $this->hasMany(Iteracao::class,'chamadoID');
    }    

    public function ultimaAtualizacao()
    {
        $agora = now();
        $ultimaAtualizacao = $this->updated_at;

        if ($ultimaAtualizacao && $ultimaAtualizacao <= $agora) {
            $diferenca = $agora->diff($ultimaAtualizacao);
            if ($diferenca->days > 366)
                return 'Mais de um ano';
            elseif ($diferenca->days >0) {
                return $diferenca->days . ' dias atrás';
            } elseif ($diferenca->h > 0) {
                return $diferenca->h . ' horas atrás';
            } else {
                return 'Menos de uma hora atrás';
            }
        } else {
            return ' ';
        }

    }
}
