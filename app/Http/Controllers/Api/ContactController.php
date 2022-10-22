<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// importo i model da usare.
use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;
use Illuminate\Support\Facades\Validator;

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
        1. accetta come parametro in ingresso i dati del form in <contactpage.vue> inviati tramite axios POST.
        2. valida i dati in ingresso: NON posso usare ->validate(), quindi
            separo la validazione dei dati in ingresso ($validator + ::make())
            dalla gestione dell'eventuale errore di validazione (if() + $validator->fails()).
        3. salva nel database i dati provenienti (tramite axios) dal form in <contactpage.vue>.
        4. invia una mail contenente quei dati.
    */
    public function store(Request $request) {
        $data = $request->all();
        
        /*
            prima gestisco la validazione usando ::make(), che accetta:
            come primo parametro un oggetto da validare,
            come secondo parametro le sue proprietà da validare, in un array.
        */
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        /*
            poi gestisco l'eventuale errore con ->fails(),
            ritornando un oggetto json al frontend, nel <contactpage.vue>.
        */
        if ( $validator->fails() ) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors() // in <errors> inserisco gli errori di validazione.
            ]);
        } // in caso di errore di validazione il codice si blocca qui, essendoci già una return per la funzione store().

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