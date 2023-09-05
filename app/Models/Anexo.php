<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    use HasFactory;

    protected $table = 'anexos';    

    protected $fillable = [
        'nome',
        'localizacao',
        'iteracaoID',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ];    

    public function iteracao()
    {
        return $this->belongsTo(Iteracao::class);
    }
}
