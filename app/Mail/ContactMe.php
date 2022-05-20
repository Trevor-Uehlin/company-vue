<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMe extends Mailable
{
    use Queueable, SerializesModels;

    public $params;

    public function __construct($params) {

        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        return $this->view('email.contact-me');
    }
}
