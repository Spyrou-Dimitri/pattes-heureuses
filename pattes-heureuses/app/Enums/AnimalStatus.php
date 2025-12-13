<?php

namespace App\Enums;

enum AnimalStatus: String
{
    case PENDING = 'pending';
    case ADOPTABLE = 'adoptable';
    case UNDERCARE = 'under_care';
    case ADOPTED = 'adopted';
    case DECEASED = 'deceased';


}
