<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interacao extends Model
{
    use HasFactory;

    protected $table = 'interacoes';

    protected $fillable = [
        'descricao',
        'datahora',
        'usuarioID',
        'chamadoID',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ];       

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuarioID');
    }

    public function chamado()
    {
        return $this->belongsTo(Chamado::class,'chamadoID');
    }

    public function anexos()
    {
        return $this->hasMany(Anexo::class,'interacaoID');
    } 
}
