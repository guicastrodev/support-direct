<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    use HasFactory;

    protected $table = 'anexos';    

    protected $fillable = [
        'hashftp',
        'nome',
        'localizacao',
        'interacaoID',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ];    

    public function interacao()
    {
        return $this->belongsTo(Interacao::class);
    }
}
