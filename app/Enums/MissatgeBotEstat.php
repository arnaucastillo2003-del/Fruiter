<?php

namespace App\Enums;

enum MissatgeBotEstat: string
{
    case PendentConfirmacio = 'pendent_confirmacio';
    case Processat = 'processat';
    case Error = 'error';
}
