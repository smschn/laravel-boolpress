<template>
    <div class="container">
        <h1>Contact us</h1>

        <!-- messaggio di corretto invio del form -->
        <div v-if="success" class="alert alert-success" role="alert">
            Thank you for contacting us. You will receive a reply within a day.
        </div>

        <!--
            al click sul button type=submit:
            prevengo il comportamento di default del <submit>
            (farebbe un reload della pagina, non avendo specificato alcun <action> o <method> nel tag <form>),
            richiamando invece la funzione sendMail().
            +
            gli <input> hanno un v-model con nome uguale al nome delle colonne della tabella leads del database:
            i dati presi da questo form vengono inviati al backend tramite sendMail()
            e vengono salvati nel database proprio in quella tabella.
        -->
        <form @submit.prevent="sendMail">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" v-model="name"> <!-- con v-model recupero il dato -->
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" v-model="email">
            </div>

            <div class="form-group">
                <label for="message">Messagge</label>
                <textarea class="form-control" id="message" rows="5" v-model="message"></textarea>
            </div>

            <!-- gestisco disabilitazione bottone attraverso variabile <sending> -->
            <button type="submit" class="btn btn-primary" v-bind:disabled='sending'>{{sending?'Sending message...':'Send'}}</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ContactPage",
        data() {
            return {
                name: '', // valori recuperati con v-model.
                email: '',
                message: '',
                success: '',
                errors: {},
                sending: false // gestisco il bottone di invio rendendolo cliccabile (false) o meno (true).
            }
        },
        methods: {

            // faccio una chiamata axios con metodo POST per inviare questi dati al backend.
            sendMail() {

                // disabilito il bottone dell'invio.
                this.sending = true;
                
                // chiamata axios post a api\contactcontroller.
                axios.post('api/contacts', {
                    'name': this.name,
                    'email': this.email,
                    'message': this.message
                }).then( (response) => {

                    // riabiliato il bottone dell'invio avendo ottenuto una risposta.
                    this.sending = false;

                    // recupero <success> dalla store() del controller, gestendola con un if.
                    this.success = response.data.success;
                    
                    if (this.success) {
                        /*
                            success = true: azzero tutti i campi, compreso errors perché:
                            al primo tentativo l'invio form fallisce: errors{} contiene errori;
                            al secondo tentativo invio form riesce: devo azzerare gli errors{}.
                        */
                        this.errors = {};
                        this.name = '';
                        this.email = '';
                        this.message = '';
                    } else {
                        // success = false: salvo gli errori.
                        this.errors = response.data.errors;
                    }
                });
            }
        }
    }
</script>

<style>
</style>