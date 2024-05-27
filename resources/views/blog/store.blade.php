@extends('base')

@section('title', 'Créer un article')

@section('content')
    <form action="" method="post">
        @csrf
        <div>
            <input type="text" name="title" value="{{ old('title', 'Renseigner un titre') }}">
            @error("title")
            {{ $message }}
            @enderror
        </div>
        <div>
        <textarea name="content" id="" cols="30" rows="10">
            {{ old('content', 'Renseigner du contenu') }}
        </textarea>
            @error("content")
            {{ $message }}
            @enderror
        </div>
        <button>Enregistrer</button>
    </form>

@endsection
