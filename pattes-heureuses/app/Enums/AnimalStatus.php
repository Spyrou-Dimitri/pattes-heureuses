<?php

namespace App\Enums;

enum AnimalStatus: String
{
    case PENDING = 'pending';
    case ADOPTABLE = 'adoptable';
    case UNDERCARE = 'under_care';
    case ADOPTED = 'adopted';
    case DECEASED = 'deceased';


    public function color(): string
    {
        return match ($this) {
            self::PENDING    => 'border-yellow-400 text-yellow-400',
            self::ADOPTABLE  => 'border-green-500 text-green-500',
            self::UNDERCARE  => 'border-blue-500 text-blue-500',
            self::ADOPTED    => 'border-purple-500 text-purple-500',
            self::DECEASED   => 'border-gray-400 text-gray-400',
        };
    }
    public function label(): string
    {
        return match ($this) {
            self::PENDING    => 'En attente',
            self::ADOPTABLE  => 'Adoptable',
            self::UNDERCARE  => 'Sous soins',
            self::ADOPTED    => 'Adopté',
            self::DECEASED   => 'Décédé',
        };
    }
}
