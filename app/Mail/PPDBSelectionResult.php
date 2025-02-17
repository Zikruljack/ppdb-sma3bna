<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\PpdbUser;

class PPDBSelectionResult extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ppdbUser;

    /**
     * Create a new message instance.
     */
    public function __construct($user, PpdbUser $ppdbUser)
    {
        //
        $this->user = $user;
        $this->ppdbUser = $ppdbUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'SMPM-Validasi Formulir Peserta Didik Baru',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.validasi',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
