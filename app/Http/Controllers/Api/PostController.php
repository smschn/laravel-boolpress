<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        con il metodo statico ::with() ricostruisco la relazione post <-> category <-> tags PRIMA di inviare i dati tramite API.
        con il metodo ->paginate() laravel costruisce il formato json di risposta alla chiamata api\axios con una struttura atta
        a mostrare risultati su più pagine: come parametro accetta il numero di risultati per pagina:
        verifico con postman i nuovi campi disponibili.
        */
        $posts = Post::with(['category', 'tags'])->paginate(2); // si chiama: Eager Loading Multiple Relationships.

        // PLACEHOLDER: inserire immagini quando le implemento.

        // faccio una return della collection <posts> che viene trasformata in formato json,
        // affinché sia utilizzabile con le api.
        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) // ricevo in ingresso lo slug da <singlepost.vue> in \resources\js\pages\.
    {
        /*
            recupero il post con lo slug in ingresso (::where), ricostruendo le relazioni con le altre tabelle (::with).
            usando firstOrFail lancio un errore in caso non trovi il post:
            recupero l'errore nel frontend (in singlepost.vue) con un .catch interno ad axios.
        */
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->firstOrFail();

        // PLACEHOLDER: inserire immagini quando le implemento.
        
        // se esiste, lo invio in formato json al front, come risposta alla chiamata axios.
        return response()->json([
            'success' => true,
            'result' => $post
        ]);
        
    }

    public function randomPost() {
        /*
            NON ho implementato una view o un vue router per mostrare i risultati.
            per testarne il funzionamento carico la URI: api/post/random,
            verifico con dd() cosa ho ricevuto.
        */
        $post = Post::inRandomOrder()->firstOrFail();
        dd($post);
        die();
        return response()->json([
            'success' => true,
            'result' => $post
        ]);
    }

}