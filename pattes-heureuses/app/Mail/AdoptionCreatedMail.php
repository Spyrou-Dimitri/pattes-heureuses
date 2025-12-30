<?php

namespace App\Mail;

use App\Models\Adoption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdoptionCreatedMail extends Mailable implements ShouldQueue
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
            from: $this->adoption->email,
            subject: 'Nouvelle demande d\'adoption',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.adoption-created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
