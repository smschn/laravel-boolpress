@extends('layouts.app')

@section('content')

    <div class="container">

        {{--
            form per cancellare solo l'immagine usando una funzione appositamente creata deleteCover().
            per funzionare deve ovviamente stare fuori dall'altro form.
        --}}
        <form action="{{route('admin.posts.deleteCover', ['post' => $post])}}" method="POST" id="deleteCoverForm">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-3">Delete post image only</button>
        </form>

        {{-- form per editare tutto --}}
        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="categoryId">Category:</label>

                {{-- nelle <option> uso l'id delle categorie per identificarle in modo univoco --}}
                <select id="categoryId" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option {{(old('category_id')=="")?'selected':''}} value="">No category selected</option>
                    @foreach ($categories as $category)
                        {{-- usare doppio parametro con <old()> e operatore ternario per precompilare correttamente la <select> --}}
                        <option {{(old('category_id', $post->category_id)==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>

                @error('category_id')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="titleT">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleT" name="title" required max="255" value="{{old('title', $post->title)}}">

                @error('title')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- aggiungo edit per l'immagine --}}
            <div class="form-group mb-3">

                {{-- se c'è già un'immagine, la mostro --}}
                <p>Current image:</p>
                @if ($post->cover)
                    <img src="{{asset('storage/' . $post->cover)}}" class="img-thumbnail mb-3" style="max-width:150px" />
                    <!-- <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteCoverForm').submit();">Delete immagine</a> -->
                @else
                    <p>No loaded image!</p>
                @endif

                <br>

                {{-- input per inserire l'immagine --}}
                <label for="cover">New image cover: </label>
                <input type="file" name="image" id="cover" class="form-control-file @error('image') is-invalid @enderror" />

                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="contentC">Content:</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="contentC" name="content" required>{{old('content', $post->content)}}</textarea>

                @error('content')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="card p-3">
                {{-- ciclo i tag, creando una checkbox ciascuno --}}
                @foreach ($tags as $tag)
                    <div class="form-group form-check">
                        {{-- 
                            se c'è un errore di validazione, entro nell'if:
                            quando la view edit viene ricaricata post validazione fallita,
                            le checkbox dei tag precedentemente selezionate vengono pre-selezionate,
                            mentre quelle NON selezionate NON vengono pre-selezionate (ripristino lo status quo al momento dell'invio dell'edit):
                            il tutto funziona grazie a <in_array()> + old() con doppio parametro.
                        --}}
                        @if ($errors->any())
                            <input class="form-check-input" type="checkbox" id="tag_{{$tag->id}}" value="{{$tag->id}}" name="tags[]" {{(in_array($tag->id, old('tags', [])))?'checked':''}}>
                            <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>              
                        {{-- 
                            altrimenti, al primo caricamento della view edit,
                            pre-seleziono le checkbox dei tag già assegnati al post (ho già una relazione nel database):
                            il tutto funziona grazie a contains():
                            controllo se nei tag del post che sto editando (usando: $post->tags: accedo alla relazione many to many come se fosse un attributo)
                            è contenuto il tag ciclato (->contains($tag)): se è contenuto, la checkbox viene selezionata, altrimenti no.
                            ->tags è una collection (simil array).
                        --}}
                        @else
                            <input class="form-check-input" type="checkbox" id="tag_{{$tag->id}}" value="{{$tag->id}}" name="tags[]" {{($post->tags->contains($tag))?'checked':''}}>
                            <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                        @endif
                    </div>
                @endforeach

                @error('tags')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Edit post</button>

        </form>

        <a href="{{route('admin.posts.index')}}" class="btn btn-primary mt-3">Back to index</a>

    </div>

@endsection