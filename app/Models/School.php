<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
    ];

    public function managers()
    {
        return $this->hasMany(SchoolManager::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}