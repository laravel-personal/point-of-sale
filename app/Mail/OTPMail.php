<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The application name.
     *
     * @var string
     */
    public $app_name;

    /**
     * The OTP.
     *
     * @var string
     */
    public $otp;

    /**
     * The first name.
     *
     * @var string
     */
    public $first_name;

    /**
     * Create a new message instance.
     */
    public function __construct( $otp, $first_name, $app_name = null) {
        $this->otp        = $otp;
        $this->first_name = $first_name;
        $this->app_name   = 'Magnet POS';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'OTP Confirmation Magnet POS',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.otpMail',
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
