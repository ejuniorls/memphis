<?php

namespace App\Enums;

enum IntegrationSystem: string
{
    case Protheus = 'protheus';
    case SAP      = 'sap';
    case RM       = 'rm';
    case AD       = 'ad';

    public function label(): string
    {
        return match($this) {
            self::Protheus => 'TOTVS Protheus',
            self::SAP      => 'SAP',
            self::RM       => 'TOTVS RM',
            self::AD       => 'Active Directory',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::Protheus => 'ki-filled ki-setting-3',
            self::SAP      => 'ki-filled ki-cube-2',
            self::RM       => 'ki-filled ki-abstract-26',
            self::AD       => 'ki-filled ki-shield-tick',
        };
    }
}
