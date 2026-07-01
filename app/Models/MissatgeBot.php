<?php

namespace App\Models;

use App\Enums\MissatgeBotEstat;
use App\Enums\MissatgeBotTipus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissatgeBot extends Model
{
    protected $table = 'missatges_bot';

    protected $fillable = [
        'whatsapp_id', 'client_id', 'comanda_id',
        'tipus', 'contingut_raw', 'transcripcio', 'estat',
    ];

    protected function casts(): array
    {
        return [
            'tipus' => MissatgeBotTipus::class,
            'estat' => MissatgeBotEstat::class,
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function comanda(): BelongsTo
    {
        return $this->belongsTo(Comanda::class);
    }
}
