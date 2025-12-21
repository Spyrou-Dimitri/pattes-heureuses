<?php

namespace App\Enums;

enum AdoptionStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    public function color(): string
    {
        return match ($this) {
            self::Pending    => 'border-yellow-400 text-yellow-400',
            self::InProgress  => 'border-green-500 text-green-500',
            self::Completed  => 'border-blue-500 text-blue-500',
            self::Cancelled   => 'border-gray-400 text-gray-400',
        };
    }

    public function label(): string {
        return match ($this) {
            self::Pending    => 'En attente',
            self::InProgress  => 'En cours',
            self::Completed  => 'Réussie',
            self::Cancelled   => 'Annulée',
        };
    }

}



