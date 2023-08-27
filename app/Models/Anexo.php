<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    public function iteracao()
    {
        return $this->belongsTo(Iteracao::class);
    }
}
