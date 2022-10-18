// questo file gestisce js per la parte pubblicamente accessibile del sito,
// cioè accessibile senza login.

// dichiaro Vue globalmente legandola all'oggetto window (la finestra del browser).
window.Vue = require('vue');

// lego axios all'oggetto window: così posso usarlo in tutti i componenti senza doverlo importare in ciascuno di essi,
// perché viene caricato con la finestra (window) del browser.
window.axios = require('axios');

/*
// specifico che tutte le richieste axios fatte al server siano fatte in json
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
*/

import Vue from 'vue'; // importo Vue.
import App from './views/App'; // importo il componente globale <App> da <\resources\js\views\App.vue>.

// creo nuova istanza di Vue.
const app = new Vue({
    el: '#root',
    render: h => h(App) // renderizzo subito il componente 'App' all'avvio.
});