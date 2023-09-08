<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioPadrao extends Model
{
    use HasFactory;

    protected $table = 'comentariospadroes';

    protected $fillable = [
        'mensagem',
        'usuarioID',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ]; 
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuarioID');
    }    
}
