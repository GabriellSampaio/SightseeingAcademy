<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolManager extends Model
{
    protected $fillable = ['school_id', 'nome', 'telefone', 'email'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function getWhatsappLinkAttribute(): ?string
    {
        if (!$this->telefone) {
            return null;
        }

        $numero = preg_replace('/\D/', '', $this->telefone);

        // Adiciona o código do Brasil (55) se o número não tiver
        if (strlen($numero) <= 11) {
            $numero = '55' . $numero;
        }

        return "https://wa.me/{$numero}";
    }
}