// importo vue e vue router.
import Vue from "vue";
import VueRouter from "vue-router";

// dico a vue di usare l'estensione vue router.
Vue.use(VueRouter);

// importo i componenti da usare nelle routes del router sotto.
import ContactPage from './pages/ContactPage.vue';
import AboutUsPage from './pages/AboutUsPage.vue';
import HomePage from './pages/HomePage.vue';

// creo una nuova istanza di vue router.
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/', // scelgo l'uri del componente vue (lo vedrò in: localhost/9999/).
            name: 'homepage', // scelgo il nome che voglio dare al componente vue (come il nome che do alle rotte in web.php).
            component: HomePage // riporto il nome del componente vue (nella sezione export del componente).
        },
        {
            path: '/contact', // (lo vedrò in: localhost/9999/contact).
            name: 'contact',
            component: ContactPage
        },
        {
            path: '/about-us',
            name: 'aboutus',
            component: AboutUsPage
        }

    ]
});

// esporto il router creato per poterlo usare nel componente globale.
export default router;