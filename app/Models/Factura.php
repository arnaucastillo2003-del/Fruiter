<?php

namespace App\Models;

use App\Enums\FacturaEstat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model
{
    protected $table = 'factures';

    protected $fillable = [
        'client_id', 'numero_factura', 'data_emissio', 'data_venciment',
        'base_imposable', 'iva', 'total', 'estat',
    ];

    protected function casts(): array
    {
        return [
            'data_emissio' => 'date',
            'data_venciment' => 'date',
            'base_imposable' => 'decimal:2',
            'iva' => 'decimal:2',
            'total' => 'decimal:2',
            'estat' => FacturaEstat::class,
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    // Una factura mensual agrupa diversos albarans.
    public function albarans(): HasMany
    {
        return $this->hasMany(Albara::class);
    }
}
