<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'school_id',
        'destination',
        'status',
        'event_date',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}