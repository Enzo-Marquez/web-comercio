<?php

namespace App\Enums;

enum UserType: string
{
    case Admin = 'admin';
    case User = 'user';
    case Moderator = 'moderator';

    public static function forMigration(): array {
        return collect(self::cases())
            ->map(function ($enum) {
                if (property_exists($enum, "value")) return $enum->value;
                return $enum->name;
            })
            ->values()
            ->toArray();
    }
}