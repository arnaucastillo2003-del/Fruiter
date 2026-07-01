<?php

namespace App\Models;

use App\Enums\ClientTipus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'nom', 'tipus', 'adreca', 'latitud', 'longitud',
        'telefon', 'whatsapp_id', 'condicions_pagament', 'actiu',
    ];

    protected function casts(): array
    {
        return [
            'tipus' => ClientTipus::class,
            'latitud' => 'decimal:7',
            'longitud' => 'decimal:7',
            'actiu' => 'boolean',
        ];
    }

    public function comandes(): HasMany
    {
        return $this->hasMany(Comanda::class);
    }

    public function preusEspecials(): HasMany
    {
        return $this->hasMany(PreuClient::class);
    }

    public function factures(): HasMany
    {
        return $this->hasMany(Factura::class);
    }

    public function missatgesBot(): HasMany
    {
        return $this->hasMany(MissatgeBot::class);
    }
}
