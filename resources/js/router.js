// importo vue e vue router.
import Vue from "vue";
import VueRouter from "vue-router";

// dico a vue di usare l'estensione vue router.
Vue.use(VueRouter);

// creo una nuova istanza di vue router.
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '', // l'uri del componente vue.
            name: '', // il nome che voglio dare al componente vue.
            component: '' // il nome del file del componente vue.
        }
    ]
});

// esporto il router creato per poterlo usare nel componente globale.
export default router;