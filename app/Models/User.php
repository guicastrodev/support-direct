<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'perfilID',
        'pessoaID',
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ]; 

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfilID');
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoaID');
    } 
    
    public function comentariospadroes()
    {
        return $this->hasMany(MsgPadrao::class,'usuarioID');
    } 

    public function chamadosGestor()
    {
        return $this->hasMany(Chamado::class,'gestorID');
    }     

    public function chamadosTecnico()
    {
        return $this->hasMany(Chamado::class,'tecnicoID');
    }     

    public function chamadosRequerente()
    {
        return $this->hasMany(Chamado::class,'requerenteID');
    }     


}
