<?php

namespace App\Enums;

enum AnimalStatus: String
{
    case Pending = 'pending';
    case Adoptable = 'adoptable';
    case UnderCare = 'under_care';
    case Adopted = 'adopted';
    case Deceased = 'deceased';
}
