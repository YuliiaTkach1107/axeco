<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResumeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $file;

    public $email;

    public function __construct($file, $email)
    {
        $this->file = $file;
        $this->email = $email;
    }

    public function build()
    {
        $fileContents = file_get_contents($this->file->getRealPath());

        return $this->from('hello@axeco.com', 'AXECO')
            ->replyTo($this->email)
            ->subject("CV de l'employé Mail")
            ->view('emails.resume')
            ->with([
                'fileName' => $this->file->getClientOriginalName(),
                'email' => $this->email,
            ])
            ->attachData(
                $fileContents,
                $this->file->getClientOriginalName(),
                ['mime' => $this->file->getMimeType()]
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
