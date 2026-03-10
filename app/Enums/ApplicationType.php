<?php

namespace App\Enums;

enum ApplicationType: string
{
    case HERBICIDE = 'HERBICIDE';
    case FUNGICIDE = 'FUNGICIDE';
    case INSECTICIDE = 'INSECTICIDE';
    case FERTILIZER = 'FERTILIZER';

    public function label(): string
    {
        return match ($this) {
            self::HERBICIDE => 'Herbicida',
            self::FUNGICIDE => 'Fungicida',
            self::INSECTICIDE => 'Inseticida',
            self::FERTILIZER => 'Fertilizante',
        };
    }
}
