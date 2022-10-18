<template>
    <div class="container">
        <!--
            inserisco un contenitore dell'istanza di vue-router presa da router.js:
            dentro di esso saranno renderizzati i componenti di vue (siti in \pages\) richiesti dall'utente,
            tramite l'utilizzo delle routes interne all'istanza del router creato.
        -->
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: 'MyMain'
    }
</script>

<style>
</style>