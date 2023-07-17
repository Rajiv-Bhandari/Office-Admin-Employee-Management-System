<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function build()
    {
        return $this->from('bhandas.3282@gmail.com')
                    ->subject('You have been registered as our staff')
                    ->view('sendemail')
                    ->with(['name' => $this->name]);
    }
}
