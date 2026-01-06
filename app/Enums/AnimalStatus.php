<?php

namespace App\Enums;

enum AnimalStatus: String
{
    case PENDING = 'pending';
    case ADOPTABLE = 'adoptable';
    case UNDERCARE = 'under_care';
    case INPROGRESS = 'in_progress';
    case ADOPTED = 'adopted';
    case DECEASED = 'deceased';


    public function color(): string
    {
        return match ($this) {
            self::PENDING    => 'border border-yellow-400 bg-yellow-400 text-white duration-300 hover:bg-transparent hover:text-yellow-400 hover:duration-300',
            self::ADOPTABLE  => 'border border-green-500 bg-green-500 text-white duration-300 hover:bg-transparent hover:text-green-500 hover:duration-300',
            self::UNDERCARE  => 'border border-blue-500 bg-blue-500 text-white duration-300 hover:bg-transparent hover:text-blue-500 hover:duration-300',
            self::INPROGRESS => 'border border-fuchsia-500 bg-fuchsia-500 text-white duration-300 hover:bg-transparent hover:text-fuchsia-500 hover:duration-300',
            self::ADOPTED    => 'border border-purple-500 bg-purple-500 text-white duration-300 hover:bg-transparent hover:text-purple-500 hover:duration-300',
            self::DECEASED   => 'border border-gray-400 bg-gray-400 text-white duration-300 hover:bg-transparent hover:text-gray-400 hover:duration-300',
        };
    }
    public function label(): string
    {
        return match ($this) {
            self::PENDING    => 'En attente',
            self::ADOPTABLE  => 'Adoptable',
            self::UNDERCARE  => 'Sous soins',
            self::INPROGRESS => 'En cours',
            self::ADOPTED    => 'Adopté',
            self::DECEASED   => 'Décédé',
        };
    }
}
