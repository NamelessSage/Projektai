<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sablonas extends Model
{
    protected $fillable = [
        'pavadinimas',
        'tema',
        'sablonas',
        'parasas',
    ];

    public function suplanuoti()
    {
        return $this->hasOne(Sablonas::class, 'sablonas_id');
    }
}
