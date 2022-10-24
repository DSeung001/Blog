<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    private $emailHistory;

    public function __construct($emailHistory)
    {
        $this->emailHistory = $emailHistory;
    }

    public function envelope()
    {
        return new Envelope(
            subject: $this->emailHistory->subject,
        );
    }

    public function content()
    {
        return new Content(
            markdown: 'emails.form',
            with: [
                'message' => $this->emailHistory->message,
                'url' => route('emailForm')
            ]
        );
    }

    public function attachments()
    {
        return [];
    }

    public function build()
    {
        return $this->markdown('emails.form');
    }
}
