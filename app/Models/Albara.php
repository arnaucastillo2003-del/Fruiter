<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Albara extends Model
{
    protected $table = 'albarans';

    protected $fillable = [
        'comanda_id', 'factura_id', 'numero_albara',
        'data_emissio', 'signat', 'pdf_path',
    ];

    protected function casts(): array
    {
        return [
            'data_emissio' => 'date',
            'signat' => 'boolean',
        ];
    }

    public function comanda(): BelongsTo
    {
        return $this->belongsTo(Comanda::class);
    }

    public function factura(): BelongsTo
    {
        return $this->belongsTo(Factura::class);
    }
}
