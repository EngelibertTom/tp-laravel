@extends('base')

@section('title', "Auteur : " . $author->first_name . " " . $author->last_name)

@section('content')
    <h1>{{ $author->first_name }} {{ $author->last_name }}</h1>
    <p>{{ $author->description }}</p>
    <h2>Posts de l'auteur :</h2>
    @foreach ($posts as $post)
        <article>
            <h2><a href="{{ route('blog.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></h2>
            <p>{{ $post->content }}</p>
        </article>
    @endforeach

    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection
