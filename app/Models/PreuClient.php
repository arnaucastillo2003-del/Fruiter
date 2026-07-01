<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreuClient extends Model
{
    protected $table = 'preus_client';

    protected $fillable = [
        'client_id', 'producte_id', 'preu_especial',
    ];

    protected function casts(): array
    {
        return [
            'preu_especial' => 'decimal:2',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function producte(): BelongsTo
    {
        return $this->belongsTo(Producte::class);
    }
}
