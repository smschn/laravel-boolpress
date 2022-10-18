<template>
    <div class="card col-12 mb-3">
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
            <!--
                aggiungo un link con l'attributo :to che porta al componente con <name>,
                passandogli come secondo parametro un elemento dinamico (lo slug del singolo post)
                che crea dinamicamente la URI per ogni singolo post (es: localhost:9999/blog/esempio-slug-dinamico).
                +
                il nome <slug> nel secondo parametro deve coincidere con il nome della parte dinamica
                scritto nella path del file routing.js.
            -->
            <router-link :to="{name: 'single-post', params: {slug: post.slug} }" class="btn btn-primary">Read more...</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MyPost',
    props: {
        post: Object // registro la proprs in ingresso e la uso nel template.
    },
    methods: {
        // metodo per tagliare il testo di un contenuto che superi una data lunghezza.
        truncateText(text, maxLength) {
            if (text.length < maxLength) {
                return text;
            } else {
                return text.substring(0, maxLength) + '...';
            }
        }
    }
}
</script>

<style>

</style>