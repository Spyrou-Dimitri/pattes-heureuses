<?php

namespace App\Observers;

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Mail\AdoptionAcceptedMail;
use App\Mail\AdoptionCreatedMail;
use App\Mail\VolunteerAccountCreatedMail;
use App\Models\Adoption;
use Illuminate\Support\Facades\Mail;

class AdoptionObserver
{
    public function created(Adoption $adoption): void
    {
        Mail::to(config('mail.from.address'))->queue(new AdoptionCreatedMail($adoption));
    }

    public function updated(Adoption $adoption): void
    {


        if ($adoption->wasChanged('status')
            && $adoption->status === AdoptionStatus::InProgress
            && $adoption->animal->state !== AnimalStatus::INPROGRESS) {
            $adoption->animal->state = AnimalStatus::INPROGRESS;
            $adoption->animal->save();
            Mail::to($adoption->email)->queue(new AdoptionAcceptedMail($adoption));

        }


        if ($adoption->wasChanged('status')
        && $adoption->status === AdoptionStatus::Cancelled
        && $adoption->animal->state === AnimalStatus::INPROGRESS) {
            $adoption->animal->state = AnimalStatus::ADOPTABLE;
            $adoption->animal->save();
        }


        if ($adoption->wasChanged('status')
        && $adoption->status === AdoptionStatus::Completed
        && $adoption->animal->state === AnimalStatus::INPROGRESS) {
            $adoption->animal->state = AnimalStatus::ADOPTED;
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
