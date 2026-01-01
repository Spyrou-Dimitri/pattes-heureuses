<?php

namespace App\Observers;

use App\Events\VolunteerCreatedEvent;
use App\Mail\VolunteerAccountCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    public function created(User $user): void
    {
        Mail::to($user->email)->send(new VolunteerAccountCreatedMail($user));

    }

    public function updated(User $user): void
    {
    }

    public function deleted(User $user): void
    {
    }

    public function restored(User $user): void
    {
    }
}
