<template>
    <div>
        <article>
            <h1 >{{post.title}}</h1>
            <div class="mb-2">{{post.category?post.category.name:'No category'}}</div>
            <div class="mb-3">
                <span v-for="tag in post.tags" class="btn btn-secondary mr-2 disabled" :key="tag.id">{{tag.name}}</span>
            </div>
            <p>{{post.content}}</p>
        </article>
    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data() {
        return {
            post: null
        }
    },
    methods: {
        getSinglePost() {

            /*
                richiamo il sistema di routing di vue ($route) (in router.js),
                cerco la route con la URI con un parametro variabile con il nome <slug>,
                salvo in una variabile lo slug del singolo post.
            */
            const slug = this.$route.params.slug;

            /*
                faccio chiamata axios per ottenere tutti i dati del singolo post con questo specifico slug.
                l'URI è <api/posts/+slug> perché è impostato così nel file api.php:
                facendo una chiamata axios a questa URI, richiamo la show() dentro il controller delle API.
            */
            axios.get('/api/posts/' + slug)
            .then( (response) => {
                this.post = response.data.result;
            })
            /*
                con una catch() gestisco l'eventuale errore della ->firstOrFail() nell'API controller:
                this.$router.push fa un redirect verso la route vue definita nel <name>
                (usando il nome definito nel file router.js).
            */
            .catch((error) => {
                this.$router.push({name: 'not-found'});
            })
        }
    },
    mounted() {
        this.getSinglePost();
    }
}
</script>

<style>
</style>