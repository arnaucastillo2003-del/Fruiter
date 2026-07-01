<?php

namespace App\Models;

use App\Enums\ProducteCategoria;
use App\Enums\ProducteUnitat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producte extends Model
{
    protected $table = 'productes';

    protected $fillable = [
        'nom', 'unitat', 'preu_venda', 'preu_cost', 'categoria', 'actiu',
    ];

    protected function casts(): array
    {
        return [
            'unitat' => ProducteUnitat::class,
            'categoria' => ProducteCategoria::class,
            'preu_venda' => 'decimal:2',
            'preu_cost' => 'decimal:2',
            'actiu' => 'boolean',
        ];
    }

    public function liniesComanda(): HasMany
    {
        return $this->hasMany(LiniaComanda::class);
    }

    public function preusEspecials(): HasMany
    {
        return $this->hasMany(PreuClient::class);
    }
}
