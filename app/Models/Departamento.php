<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';    

    protected $fillable = [
        'nome',
        'descricao',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ];    

    public function categoria()
    {
        return $this->hasOne(Categoria::class,'departamentoID');
    }     
}
