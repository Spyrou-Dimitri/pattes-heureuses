<?php

namespace App\Enums;

enum SexeVolunteer: string
{
    case Man = 'man';
    case Woman = 'woman';

    public function label():string {
        return match ($this) {
            self::Man => 'Homme',
            self::Woman => 'Femme',
        };
    }
 }
