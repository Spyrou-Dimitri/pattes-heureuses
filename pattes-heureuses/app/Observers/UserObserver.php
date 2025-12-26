<?php

namespace App\Observers;

use App\Events\VolunteerCreatedEvent;
use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        event(new VolunteerCreatedEvent($user));
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
