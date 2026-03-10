<?php

namespace App\Enums;

enum DoseUnit: string
{
    case L_HA = 'L_HA';
    case ML_HA = 'ML_HA';
    case KG_HA = 'KG_HA';
    case G_HA = 'G_HA';

    public function label(): string
    {
        return match ($this) {
            self::L_HA => 'L/ha',
            self::ML_HA => 'mL/ha',
            self::KG_HA => 'Kg/ha',
            self::G_HA => 'g/ha',
        };
    }
}
