<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iteracao extends Model
{
    use HasFactory;

    protected $table = 'iteracoes';

    protected $fillable = [
        'descricao',
        'datahora',
        'usuarioID',
        'chamadoID',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuarioID');
    }

    public function chamado()
    {
        return $this->belongsTo(Chamado::class,'chamadoID');
    }
}
