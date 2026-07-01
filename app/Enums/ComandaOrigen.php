<?php

namespace App\Enums;

enum ComandaOrigen: string
{
    case WhatsappText = 'whatsapp_text';
    case WhatsappAudio = 'whatsapp_audio';
    case Manual = 'manual';
}
