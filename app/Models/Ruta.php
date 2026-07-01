<?php

namespace App\Models;

use App\Enums\RutaEstat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruta extends Model
{
    protected $table = 'rutes';

    protected $fillable = [
        'data', 'vehicle', 'estat',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'date',
            'estat' => RutaEstat::class,
        ];
    }

    // Les parades de la ruta són les comandes, ordenades per ordre_ruta.
    public function comandes(): HasMany
    {
        return $this->hasMany(Comanda::class)->orderBy('ordre_ruta');
    }
}
