<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id' // aggiungere la nuova colonna della foreign key affinché funzioni il metodo fill() dentro la store() del controller dei post.
    ];

    // aggiungo la relazione ONE TO MANY con la tabella (e quindi il model) <categories>: one (category) to many (posts).
    // la funzione ha il nome della tabella con cui sussiste la relazione, al singolare (per ogni post ho una sola categoria).
    // si può accedere a questa funzione come se fosse un normale attributo\proprietà del singolo oggetto <post>.
    public function category() {
        return $this->belongsTo('App\Category'); // ritorno il model della tabella con cui c'è la relazione.
    }

    // aggiungo la relazione MANY TO MANY con la tabella (e quindi il model) <tags>.
    // la funzione ha il nome della tabella con cui sussiste la relazione.
    public function tags() {
        return $this->belongstoMany('App\Tag'); // ritorno il model della tabella con cui c'è la relazione.
        // 'leggendo il codice' è come dire: ad un post appartengono più tag.
    }
}