<template>
    <h1>Single post page</h1>
</template>

<script>
export default {
    name: 'SinglePost',
    methods: {
        getSinglePost() {

            // salvo in una variabile lo slug.
            const slug = this.$route.params.slug;

            /*
                faccio chiamata axios per ottenere tutti i dati del singolo post con questo specifico slug.
                l'uri è <api/posts/+slug> perché è impostato così nel file api.php:
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