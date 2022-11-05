@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary" href="{{route('admin.posts.create')}}">Add new post</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col">ID #</th>
                  <th scope="col">Title</th>
                  <th scope="col">Slug</th>
                  <th scope="col">Category</th>
                  <th scope="col">Tags</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td scope="row">{{$post->id}}</td>
                    <td scope="row">
                        @if ($post->cover)
                            <img src="{{asset('storage/' . $post->cover)}}" class="img-thumbnail" style="width:75px" />
                        @else
                            <img src="{{asset('img/no_img.png')}}" class="img-thumbnail" style="width:75px" />
                        @endif
                    </td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    {{--
                        accedo alla <category> (funzione) del model <post> come se fosse un suo attributo\proprietà:
                        laravel, in automatico, parte dall'id della foreign key,
                        va alla tabella <categories> alla relativa riga e restituisce il valore richiesto (->name).
                    --}}
                    <td>{{($post->category)?$post->category->name:'-'}}</td>
                    {{--
                        se il post ha dei tag (verifico grazie a count()), li ciclo e stampo il loro nome; altrimenti stampo <no tag>.
                        accedo ai <tags> (funzione) del model <post> come se fosse un suo attributo\proprietà:
                        trattandosi di una relazione many to many, tags è una collection\array:
                        va ciclata per stampare un tag alla volta (anche se c'è solo un tag).
                    --}}
                    <td>
                        @if (count($post->tags))
                            @foreach ($post->tags as $tag)
                                <span class="btn btn-secondary disabled">{{$tag->name}}</span>
                            @endforeach
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td class="d-flex">
                        {{--
                            gestisco i pulsanti con un @if:
                            - se il post è stato cancellato con la soft delete attiva,
                                (quindi ha il campo <deleted_at>) mostro:
                                - il pulsante restore.
                                - il pulsante forceDelete.
                            - se il post NON è stato cancellato, mostro i 3 pulsanti di default.
                        --}}
                        @if ($post->deleted_at)
                            <a href="{{route('admin.posts.restore', ['post' => $post->id])}}" class="btn btn-success mx-1">Restore</a>
                            <form method="POST" action="{{route('admin.posts.forceDelete', ['post' => $post->id])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning mx-1">Force delete</button>
                            </form>
                        @else
                        <a href="{{route('admin.posts.show', ['post' => $post->id])}}" class="btn btn-primary mx-1">View</a>
                        <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" class="btn btn-dark mx-1">Edit</a>
                        <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection