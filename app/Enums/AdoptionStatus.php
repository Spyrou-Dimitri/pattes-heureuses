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
            self::Pending    => 'border-2 border-yellow-400 bg-yellow-400 text-white duration-300 hover:bg-transparent hover:text-yellow-400 hover:duration-300',
            self::InProgress => 'border-2 border-green-500 bg-green-500 text-white duration-300 hover:bg-transparent hover:text-green-500 hover:duration-300',
            self::Completed  => 'border-2 border-blue-500 bg-blue-500 text-white duration-300 hover:bg-transparent hover:text-blue-500 hover:duration-300',
            self::Cancelled  => 'border-2 border-gray-400 bg-gray-400 text-white duration-300 hover:bg-transparent hover:text-gray-400 hover:duration-300',
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



