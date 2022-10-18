<template>
    <div class="container">
        <h1 class="mb-3">Posts list</h1>
        <!-- loader con if -->
        <div v-if="loading" class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- lista post con else (a fine risposta api viene mostrata questa lista) -->
        <div v-else class="row">
            <div class="card col-12 mb-3" v-for="(post, index) in posts" v-bind:key="index">
                <div class="card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <!--
                        ricorda: prima serve ricostruire le relazioni nella api con il metodo statico ::with.
                        poi, con operatore ternario verifico presenza categoria e stampo di conseguenza.
                    -->
                    <p class="card-text">{{post.category?post.category.name:'-'}}</p>
                    <!-- per mezzo di una funzione taglio il testo del contenuto -->
                    <p class="card-text">{{truncateText(post.content, 15)}}</p>
                    <!-- aggiungo i tag (sono un array contenuto in post) -->
                    <ul v-if="post.tags.length" class="card-text list-unstyled d-flex">
                        <li v-for="(tag, index) in post.tags" v-bind:key='index' class="btn btn-secondary mr-2 disabled">{{tag.name}}</li>
                    </ul>
                    <p v-else>-</p>
                    <a href="#" class="btn btn-primary">Read more...</a>
                </div>
            </div>
        </div>
        <!-- paginazione -->
        <nav>
            <ul class="pagination">
                <!--
                    uso un operatore ternario per disabilitare i pulsanti in prima e ultima pagina.
                    al click su un bottone, richiamo la funzione getPosts() passando come parametro il numero della pagina successiva\precedente.
                    uso un <.prevent> per prevenire l'evento che scatena il tag <a> (cioè il caricamento della pagina con url </#>).
                -->
                <li class="page-item" v-bind:class="(currentPage==1?'disabled':'')"><a class="page-link" href="#" @click.prevent="getPosts(currentPage - 1)">Previous</a></li>
                <li class="page-item disabled"><span class="page-link">{{currentPage}}/{{lastPage}}</span></li>
                <li class="page-item" v-bind:class="(currentPage==lastPage)?'disabled':''"><a class="page-link" href="#" @click.prevent="getPosts(currentPage + 1)">Next</a></li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'MyMain',
    data() {
        return {
            posts: [],
            loading: true, // variabile per mostrare un loader.
            currentPage: 1,
            lastPage: null // saprò il numero solo dopo la chiamata api.
        }
    },
    methods: {
        // metodo per catturare i post dalla api tramite axios.
        getPosts(page) {

            // ad ogni chiamata axios setto il loader su true per farlo apparire in pagina.
            this.loading = true;

            /*
                per sapere l'url da contattare, controllare la lista delle routes con: php artisan route:list.
                per gestire i post su più pagine, uso il secondo parametro di get() per gestire le query dinamicamente:
                per ottenere un link del tipo: <../api/posts?page=1> (vedi in postman),
                con il numero del parametro <page> passato dall'html all'evento @click.
            */
            axios.get('/api/posts', {
                params: {
                    page: page
                }
            })
            .then( (response) => {
                this.posts = response.data.results.data; // attenzione: DOPO la ->paginate() i post cambiano path nel json.
                this.currentPage = response.data.results.current_page; // dati presenti solo DOPO la ->paginate() nell'api controller.
                this.lastPage = response.data.results.last_page; // dati presenti solo DOPO la ->paginate().
                this.loading = false; // setto il loader a false una volta ricevuta la risposta dall'api.
            })
        },
        // metodo per tagliare il testo di un contenuto che superi una data lunghezza.
        truncateText(text, maxLength) {
            if (text.length < maxLength) {
                return text;
            } else {
                return text.substring(0, maxLength) + '...';
            }
        }
    },
    mounted() {
        /*
            lancio la chiamata api al montaggio dell'istanza di vue.
            di default, la funzione mostra la pagina numero 1.
        */
        this.getPosts(1);
    }
}
</script>

<style>

</style>