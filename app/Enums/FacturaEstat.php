<?php

namespace App\Enums;

enum FacturaEstat: string
{
    case Pendent = 'pendent';
    case Pagada = 'pagada';
    case Vencuda = 'vencuda';
}
