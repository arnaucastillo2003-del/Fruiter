<?php

namespace App\Enums;

enum RutaEstat: string
{
    case Planificada = 'planificada';
    case EnCurs = 'en_curs';
    case Completada = 'completada';
}
