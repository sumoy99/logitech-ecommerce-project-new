<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
        use Queueable, SerializesModels;
    
        public $data;
    
        /**
         * Create a new message instance.
         */
        public function __construct($data)
        {
            $this->data = $data;
        }
    
        /**
         * Build the message.
         */
        public function build()
        {
            return $this->subject(
                $this->data['status'] == 'approved'
                    ? '🎉 Your Order is Approved!'
                    : '🧾 We’ve received your order. We’ll review and approve it soon.'
            )
            ->view('email.invoice_mail')
            ->with('data', $this->data)
            ->from(get_settings('smtp_user'),get_settings('system_title'));
        }
}
