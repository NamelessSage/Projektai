<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplanuoti extends Model
{
    protected $fillable = [
        'klientas_id',
        'sablonas_id',
        'start_date',
        'how_long',
        'frequency',
        'repeat',
        'last_sent',

    ];

    public function klientas()
    {
        return $this->belongsTo(Klientas::class);
    }

    public function sablonas()
    {
        return $this->belongsTo(Sablonas::class);

    }
}
