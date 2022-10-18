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
                    <a class="nav-link" v-bind:href="link.link">{{link.text}}</a>
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
                    link: '#'
                },
                {
                    text: 'Blog',
                    link: '#'
                },
                {
                    text: 'About us',
                    link: '#'
                },
                {
                    text: 'Contact',
                    link: '#'
                }
            ]
        }
    }
}
</script>

<style>

</style>