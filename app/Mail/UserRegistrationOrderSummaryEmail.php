<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistrationOrderSummaryEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $body;

    public function __construct($body)
    {
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from("noreply@indiamobilecongress.com", "Team IMC")->view('emails/confirmation-user-order-summary-registration')->subject("IMC 2024 Registration Confirmation")->with('body', $this->body)->attach($this->body['eticket_path']);
    }
}
