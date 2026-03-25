<?php

namespace App\Enums;

enum FarmRole: string
{
    case OWNER = 'OWNER';
    case AGRONOMIST = 'AGRONOMIST';
    case EMPLOYEE = 'EMPLOYEE';
    case VIEWER = 'VIEWER';

    public function label(): string
    {
        return match ($this) {
            self::OWNER => 'Proprietário',
            self::AGRONOMIST => 'Agrônomo',
            self::EMPLOYEE => 'Funcionário',
            self::VIEWER => 'Visualizador',
        };
    }
}
