<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class EditDocumentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $document;
    public function __construct($document)
    {
        $this->document = $document;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [
                new Address(auth()->user()->email ?? $this->document->email, auth()->user()->name ?? $this->document->name),
            ],
            subject: $this->document->doc_name." "." document has been completed by "." ".$this->document->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails/send-document',
            with: [
                'subject' => $this->document->doc_name." "." document has been completed by "." ".$this->document->name,
                'message' => $this->document->doc_name." "." document has been completed by "." ".$this->document->name,
                'link'=>$this->document->link,
                'name'=>$this->document->name,
                'avatar'=>$this->document->avatar
            ],
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
