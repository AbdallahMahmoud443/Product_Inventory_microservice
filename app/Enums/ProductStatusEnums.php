<?php

namespace App\Enums;

enum ProductStatusEnums: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case DISCONTINUED = 'discontinued';

    public static function values(): array
    {
        return array_values(self::cases());
    }
}
