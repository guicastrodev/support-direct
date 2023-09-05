<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';    

    protected $fillable = [
        'nome', 
        'empresa', 
        'endereco', 
        'telefone', 
        'cpfcnpj', 
        'especialidade',
        'disponibilidade', 
        'departamentoID',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ]; 

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamentoID');
    }
}
