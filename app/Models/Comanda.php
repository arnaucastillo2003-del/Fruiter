<?php

namespace App\Models;

use App\Enums\ComandaEstat;
use App\Enums\ComandaOrigen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comanda extends Model
{
    protected $table = 'comandes';

    protected $fillable = [
        'client_id', 'ruta_id', 'ordre_ruta', 'data_entrega',
        'franja_horaria', 'estat', 'origen', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'data_entrega' => 'date',
            'estat' => ComandaEstat::class,
            'origen' => ComandaOrigen::class,
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function ruta(): BelongsTo
    {
        return $this->belongsTo(Ruta::class);
    }

    public function linies(): HasMany
    {
        return $this->hasMany(LiniaComanda::class);
    }

    public function albara(): HasOne
    {
        return $this->hasOne(Albara::class);
    }

    // Total de la comanda calculat a partir de les línies.
    public function total(): float
    {
        return (float) $this->linies->sum('subtotal');
    }
}
