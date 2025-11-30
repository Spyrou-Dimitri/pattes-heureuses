<?php

namespace App\Enums;

enum AnimalStatus: String
{
    case Pending = 'A traité';
    case Adoptable = 'Adoptable';
    case UnderCare = 'En soin';
    case Adopted = 'Adopté';
    case Deceased = 'Décédé';
}
