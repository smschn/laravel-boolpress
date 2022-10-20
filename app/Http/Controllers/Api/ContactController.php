<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// importo i model da usare.
use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class ContactController extends Controller
{
    // funzione per testare l'invio di una mail.
    public function sendEmailTest() {
        /*
            recupero il lead di test dal database (è stato creato manualmente nella tabella leads);
            testo l'invio della mail usando il model <Mail>,
            con il metodo statico :to() = a chi la invio,
            con ->send() = che cosa invio (un nuovo oggetto mail che contiene i dati presi dal database).
        */
        $leadTest = Lead::find(1);
        Mail::to('admin@boolpress.com')->send(new NewContact($leadTest));
    }
}