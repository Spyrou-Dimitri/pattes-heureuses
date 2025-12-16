<?php

namespace App\Enums;

enum RoleVolunteer: string
{
    case Admin = 'admin';
    case Volunteer = 'volunteer';
    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Volunteer => 'Bénévole',
        };
    }
}
