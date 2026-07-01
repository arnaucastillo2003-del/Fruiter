<?php

namespace App\Enums;

enum ComandaEstat: string
{
    case Pendent = 'pendent';
    case Confirmada = 'confirmada';
    case Entregada = 'entregada';
    case Cancellada = 'cancellada';
}
