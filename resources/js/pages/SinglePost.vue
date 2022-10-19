<template>
    <h1>Single post page</h1>
</template>

<script>
export default {
    name: 'SinglePost',
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
                console.log(response.data);
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