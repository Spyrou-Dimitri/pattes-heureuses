<?php

namespace App\Listeners;

use App\Mail\VolunteerAccountCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendVolunteerAccountMailListener
{
    public function __construct()
    {
    }

    public function handle($event): void
    {
        Mail::to($event->user)->queue(new VolunteerAccountCreatedMail($event->user));
    }
}
