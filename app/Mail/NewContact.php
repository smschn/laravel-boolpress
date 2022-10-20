<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContact extends Mailable
{
    use Queueable, SerializesModels;

    // definisco una variabile pubblica\accessibile.
    public $lead;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_lead)
    {
        $this->lead = $_lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new_contact', ['lead' => $this->lead]);
        // return $this->view('emails.new-contact'); questa sintassi è valida solo se $lead è public.
    }
}