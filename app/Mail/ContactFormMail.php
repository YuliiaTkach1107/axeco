<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $file;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $file)
    {
         $this->data = $data;
         $this->file = $file;
    }
   public function build(){
        $mail = $this->from('hello@axeco.com', 'AXECO') 
                    ->replyTo($this->data['email'], $this->data['frname'].' '.$this->data['name']) 
                    ->subject('Contact Form: '.$this->data['subject']) 
                    ->view('emails.contact') 
                    ->with('data', $this->data);
        if ($this->file) {
        $mail->attach(
            $this->file->getRealPath(),
            [
                'as' => $this->file->getClientOriginalName(),
                'mime' => $this->file->getMimeType(),
            ]
        );
    }
    return $mail;
                    
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
          $subjects = [
                'info' => 'Information générale',
                'commande' => 'Commande plaquette(s)',
                'demande' => 'Demande offre',
                'stage' =>'Demande de stage'
                ];
        return new Envelope(
            subject: 'Contact Form: ' . ($subjects[$this->data['subject']] ?? 'Autre')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
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
