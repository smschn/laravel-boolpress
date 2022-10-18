<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Boolpress</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- ciclo i link; ricorda: usa la :key con l'index. -->
                <li v-for="(link, index) in navbarLinks" class="nav-item" v-bind:key="index">
                    <!--
                        al posto del tag <a> uso il <router-link> che è un componente:
                        esso NON fa partire una richiesta GET verso il server per richiedere la pagina.
                        +
                        aggiungo l'attributo :to="{name:}" in cui indico il nome della route di vue da caricare:
                        così facendo, nel file router.js, vue risale dal nome della route:
                        1. al componente da mostrare, nascondendo gli altri.
                        2. all'uri, che viene modificato (nonostante non ci sia un vero cambio di pagina).
                    -->
                    <router-link class="nav-link" :to="{name: link.routeName}">{{link.text}}</router-link>
                </li>
            </ul>
        </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'MyHeader',
    data() {
        return {
            navbarLinks: [
                {
                    text: 'Home',
                    routeName: 'homepage' // come link inserisco i <name> delle routes del router nel file <router.js>.
                },
                {
                    text: 'Blog',
                    routeName: 'blog'
                },
                {
                    text: 'About us',
                    routeName: 'aboutus'
                },
                {
                    text: 'Contact',
                    routeName: 'contact'
                }
            ]
        }
    }
}
</script>

<style>

</style>