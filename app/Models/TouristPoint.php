<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristPoint extends Model
{
    use HasFactory;

    // Define a tabela associada (opcional se seguir o padrão do Laravel, mas boa prática)
    protected $table = 'tourist_points';

    protected $fillable = [
        'name',
        'price_per_person',
        'image',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
    ];
}