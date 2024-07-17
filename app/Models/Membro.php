<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'nome',
        'genero',
        'batizado',
        'confirmado',
        'regiao',
        'paroquia',
        'estado_civil',
        'funcao',
        'data_nascimento',
    ];

    protected $casts = [
        'batizado' => 'boolean',
        'confirmado' => 'boolean',
    ];
}
