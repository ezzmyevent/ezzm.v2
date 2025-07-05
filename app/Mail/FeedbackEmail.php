<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackEmail extends Mailable
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
        //return $this->from("indiadesignid@ogaan.co.in", "India Design ID 2022")->view('emails/register-template')->subject("India Design ID 2022 Ticket Booking Confirmation")->with('body',$this->body);
        return $this
        ->subject('Requesting Feedback - SIMULIA Technology Day | Hyderabad| 2 August')
        ->markdown('emails.feedback-template');
    }
}

?>