<?php

namespace App\Enums;

enum ContactType: string
{
    case Personal    = 'personal';
    case Commercial  = 'commercial';
    case WhatsApp    = 'whatsapp';
    case Fax         = 'fax';
    case Extension   = 'extension';

    public function label(): string
    {
        return match($this) {
            self::Personal   => 'Pessoal',
            self::Commercial => 'Comercial',
            self::WhatsApp   => 'WhatsApp',
            self::Fax        => 'Fax',
            self::Extension  => 'Ramal',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::Personal   => 'ki-filled ki-phone',
            self::Commercial => 'ki-filled ki-briefcase',
            self::WhatsApp   => 'ki-filled ki-message-text',
            self::Fax        => 'ki-filled ki-printer',
            self::Extension  => 'ki-filled ki-setting-2',
        };
    }
}
