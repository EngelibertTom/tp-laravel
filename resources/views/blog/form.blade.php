<form action="" method="post" class="vstack gap-2">
    @csrf
    <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}">
        @error("title")
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug :</label>
        <input type="text" class="form-control" name="slug" value="{{ old('slug', $post->slug) }}">
        @error("slug")
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="category_id">Catégorie :</label>
        <select name="category_id" id="category_id" class="form-control">
            <option value="">Sélectionner une catégorie</option>
            @foreach ($categories as $category)
                <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{
                $category->name }}</option>
            @endforeach
        </select>
        @error("category_id")
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="tags">Tags :</label>
        <select name="tags[]" id="tags" class="form-control" multiple>
            <option value="">Sélectionner des tags</option>
            @foreach ($tags as $tag)
                <option @selected(old('tags') ? collect(old('tags'))->contains($tag->id) : $post->tags->pluck('id')->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        @error("tags")
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="author_id">Auteur :</label>
        <select name="author_id" id="author_id" class="form-control">
            <option value="">Sélectionner un auteur</option>
            @foreach ($authors as $author)
                <option @selected(old('author_id', $post->author_id) == $author->id) value="{{ $author->id }}">
                    {{ $author->first_name }} {{ $author->last_name }}
                </option>
            @endforeach
        </select>
        @error("author_id")
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Contenu :</label>
        <textarea name="content" id="content" class="form-control">{{ old('content', $post->content) }}</textarea>
        @error("content")
        {{ $message }}
        @enderror
    </div>
    <button class="btn btn-primary">
        @if ($post->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
