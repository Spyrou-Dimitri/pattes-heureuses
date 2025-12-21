<?php

namespace App\Observers;

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Models\Adoption;

class AdoptionObserver
{
    public function created(Adoption $adoption): void
    {

    }

    public function updated(Adoption $adoption): void
    {
        if ($adoption->wasChanged('status')
            && $adoption->status === AdoptionStatus::InProgress
            && $adoption->animal->state !== AnimalStatus::INPROGRESS) {
            $adoption->animal->state = AnimalStatus::INPROGRESS;
            $adoption->animal->save();
        }
    }

    public function deleted(Adoption $adoption): void
    {
    }

    public function restored(Adoption $adoption): void
    {
    }
}
