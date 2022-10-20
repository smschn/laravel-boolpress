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
    /*
    funzione per testare l'invio di una mail.
    public function sendEmailTest() {
        
            recupero il lead di test dal database (è stato creato manualmente nella tabella leads);
            testo l'invio della mail usando il model <Mail>,
            con il metodo statico :to() = a chi la invio,
            con ->send() = che cosa invio (un nuovo oggetto mail che contiene i dati presi dal database).

        funzione usata solo come test
        $leadTest = Lead::find(1);
        Mail::to('admin@boolpress.com')->send(new NewContact($leadTest));
        
    }
    */

    /*
        funzione che:
        1. salva nel database i dati provenienti (tramite axios) dal form in <contactpage.vue>.
        2. invia una mail contenente quei dati.
    */
    public function store(Request $request) {
        $data = $request->all();
        $newLead = new Lead();
        $newLead->fill($data); // ricorda: aggiungere i campi nella $fillable del model <Lead>.
        $newLead->save();

        // invio una mail con il lead appena ricevuto dal frontend.
        Mail::to('admin@boolpress.com')->send(new NewContact($newLead));

        return response()->json([
            'success' => true
        ]);
    }
}