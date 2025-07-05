<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOTPMail extends Mailable
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
        return $this->from("noreply@ezzmyevent.in", "Your OTP for Verification")->view('emails/send_otp')->subject("Thank you for registering for Ezzmyevent 2025.")->with('body',$this->body);

        // return $this->subject('Your OTP for Verification')->view('emails.send_otp');

        /*
        return $this
            ->subject('Confirmation - ServiceNow Smart Registration Sofitel| Mumbai | 22 September 2022')
            ->attach($this->body["eticket_path"], ['mime' => 'image/png'])
            ->markdown('emails.register-template');
        */

    }
}

?>