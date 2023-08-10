<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'empresa', 'endereco', 'telefone', 'cpfcnpj', 'tipo', 'especialidade',
        'disponibilidade', 'departamento', 'usuarioID',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
