<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResumeMail extends Mailable
{
   use Queueable, SerializesModels;

    public $file;
    public $email;

    public function __construct($file, $email)
    {
        $this->file = $file;   // UploadedFile
        $this->email = $email; // email кандидата
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
                        $fileContents, // содержимое файла
                        $this->file->getClientOriginalName(),         // имя файла
                            ['mime' => $this->file->getMimeType(),]
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
