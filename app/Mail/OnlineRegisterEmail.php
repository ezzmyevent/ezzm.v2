<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OnlineRegisterEmail extends Mailable
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

    public function build(){
        return $this->from("noreply@ezzmyevent.in", "LKQI Family Day")->view('emails/register-template')->subject("LKQI 2025 : Your exclusive QR code for registration ")->attach($this->body["eticket_path"], ['mime' => 'image/png'])->with('body',$this->body);
    }
}

?>