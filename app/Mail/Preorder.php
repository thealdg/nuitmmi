<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Preorder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($cart,$infos)
    {
        $this->cart = $cart;
        $this->infos = $infos;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Résumé de votre précommande',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $total = 0;
        foreach($this->cart as $product){
            $total+= $product["quantity"]*$product["price"];

        }
        return new Content(
            view: 'emails.preorder',
            with: ["cart"=>$this->cart,"infos"=>$this->infos,"total"=>$total]
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
