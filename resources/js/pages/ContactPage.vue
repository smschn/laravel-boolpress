<template>
    <div class="container">
        <h1>Contact us</h1>
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

            <button type="submit" class="btn btn-primary">Submit</button>
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
                message: ''
            }
        },
        methods: {
            // faccio una chiamata axios con metodo POST per inviare questi dati al backend.
            sendMail() {
                axios.post('api/contacts', {
                    'name': this.name,
                    'email': this.email,
                    'message': this.message
                }).then( (response) => {
                    console.log(response);
                });
            }
        }
    }
</script>

<style>
</style>