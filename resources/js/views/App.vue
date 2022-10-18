<!--
    questo file è un componente globale:
    funge da involucro per tutta la parte della web app accessibile a chi NON ha effettuato il login.
    qui importo, registro ed uso gli altri componenti creati per questa parte del sito pubblicamente accessibile.
-->

<template>
    <div>
        <MyHeader />
        <MyMain />
    </div>
</template>

<script>
    // importo i componenti
    import MyHeader from '../components/MyHeader.vue';
    import MyMain from '../components/MyMain.vue';

    export default {
        name: 'App',
        components: {
            MyHeader,
            MyMain
        }
    }
</script>