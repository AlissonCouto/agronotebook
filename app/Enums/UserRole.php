<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'ADMIN';
    case PRODUCER = 'PRODUCER';
    case TECHNICAL = 'TECHNICAL';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::PRODUCER => 'Produtor',
            self::TECHNICAL => 'Técnico',
        };
    }
}
