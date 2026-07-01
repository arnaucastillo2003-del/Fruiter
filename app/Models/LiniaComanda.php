<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiniaComanda extends Model
{
    protected $table = 'linies_comanda';

    protected $fillable = [
        'comanda_id', 'producte_id', 'quantitat', 'preu_unitari', 'subtotal',
    ];

    protected function casts(): array
    {
        return [
            'quantitat' => 'decimal:3',
            'preu_unitari' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    public function comanda(): BelongsTo
    {
        return $this->belongsTo(Comanda::class);
    }

    public function producte(): BelongsTo
    {
        return $this->belongsTo(Producte::class);
    }
}
