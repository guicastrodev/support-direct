<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';    

    protected $fillable = [
        'nome',
        'descricao',
        'departamentoID',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ];    

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamentoID');
    }
}
