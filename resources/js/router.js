// importo vue e vue router.
import Vue from "vue";
import VueRouter from "vue-router";

// dico a vue di usare l'estensione vue router.
Vue.use(VueRouter);

// importo i componenti da usare nelle routes del router sotto.
import ContactPage from './pages/ContactPage.vue';
import AboutUsPage from './pages/AboutUsPage.vue';
import HomePage from './pages/HomePage.vue';
import PostsPage from './pages/PostsPage.vue';
import NotFound from './pages/NotFound.vue';
import SinglePost from './pages/SinglePost.vue';

// creo una nuova istanza di vue router.
const router = new VueRouter({
    mode: "history", // impedisce che nell'URI appaia il <#> quando clicco link gestiti da <router-link>.
    routes: [
        {
            path: '/', // scelgo l'uri del componente vue (l'url sarà: localhost/9999/).
            name: 'homepage', // scelgo il nome che voglio dare al componente vue (come il nome che do alle rotte in web.php).
            component: HomePage // riporto il nome del componente vue (nella sezione export del componente).
        },
        {
            path: '/contact', // (l'url sarà: localhost/9999/contact).
            name: 'contact',
            component: ContactPage
        },
        {
            path: '/about-us',
            name: 'aboutus',
            component: AboutUsPage
        },
        {
            path: '/blog',
            name: 'blog',
            component: PostsPage
        },
        {
            path: '/blog/:slug', // creo una route con una parte dinamica (:slug) per gestire ogni singolo post.
            name: 'single-post',
            component: SinglePost
        },
        {
            path: '/*', // raccolgo tutti gli uri che non sono presenti in questo array.
            name: 'not-found',
            component: NotFound
        }
    ]
});

// esporto il router creato per poterlo usare nel componente globale (ora devo importarlo in front.js).
export default router;