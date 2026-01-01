<?php

namespace App\Mail;

use App\Models\Adoption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdoptionAcceptedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Adoption $adoption
    )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: config('mail.from.address'),
            subject: 'Adoption Acceptée !',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.adoption-accepted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
