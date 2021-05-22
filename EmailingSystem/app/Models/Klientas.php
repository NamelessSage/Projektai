<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klientas extends Model
{
    protected $fillable = [
        'vardas',
        'pavarde',
        'elpastas',
        'kategorija',
    ];

    public function suplanuoti()
    {
        return $this->hasOne(Suplanuoti::class, 'klientas_id');
    }
}
