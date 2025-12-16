<?php

namespace App\Enums;

enum SexeAnimal: string
{
    case Male = 'male';
    case Female = 'female';

    public function label():string {
        return match ($this) {
            self::Male => 'Male',
            self::Female => 'Femelle'
        };
    }
}


