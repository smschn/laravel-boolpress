{{-- 
    questo è il messaggio che l'amministratore del sito riceve
    quando viene compilato ed inviato un form di contatto
    dal frontend, nel componente <contactpage.vue>.
    +
    riceve $lead dalla build() del model <NewContact> in \mail\ e ne stampa i valori.
--}}
<h1>Hello Booleaner!</h1>
<p>
    You have received a new email. Here are the details:<br />
    Name: {{$lead->name}}<br />
    Email address: {{$lead->email}}<br />
    Message: {{$lead->message}}<br />
</p>