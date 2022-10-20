<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContact extends Mailable
{
    use Queueable, SerializesModels;

    // questa classe rappresenta una mail.

    // definisco una variabile pubblica\accessibile.
    public $lead;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    /*
         il __construct accetta come parametro in ingresso $_lead:
         è un oggetto proveniente dal frontend,
         inviato dal form di contatto (nel componente contactpage.vue) tramite axios con metodo POST,
         e contiene i 3 campi <input> del form (name+email+message) con i rispettivi valori.
    */
    public function __construct($_lead)
    {
        $this->lead = $_lead; // assegno il parametro in ingresso alla variabile pubblica.
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*
            faccio una return alla view, passando come dato il $lead,
            che ora contiene i 3 campi <input> del form (name+email+message) con i rispettivi valori.
        */
        return $this->view('emails.new_contact', ['lead' => $this->lead]);
        // return $this->view('emails.new-contact'); questa sintassi è valida solo se $lead è public.
    }
}