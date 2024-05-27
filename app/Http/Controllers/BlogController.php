<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\CreatePostRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(BlogFilterRequest $request): View
    {


//        $post = Post::find(4);
//        $post->category_id = 1;
//        $post->save();


//        $post = Post::find(2);
//        $post->tags()->createMany([
//            [
//                'name' => 'Tag 1'
//            ],
//            [
//                'name' => 'Tag 2'
//            ]
//        ]);

        return view('blog.index', [
            'posts' => Post::paginate(2)
        ]);
    }

    public function createPostModel() {

        $post = new Post();
        $post->title = 'mon premier article';
        $post->slug = 'mon-premier-article';
        $post->content = 'Mon premier contenu';
        $post->save();


        $posts =  Post::all(['id', 'title']);

        return $post;
    }

    public function show(Post $post): RedirectResponse | View
    {

        return view('blog.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        $post = new Post();
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
            'authors' => Author::select('id', 'first_name', 'last_name')->get(),
        ]);
    }

    public function store(CreatePostRequest $request)
    {


        $post = Post::create($request->validated());
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('blog.show', ['post' => $post->slug])->with('success', "L'article a bien été sauvegardé");
    }

    public function edit(Post $post)
    {
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
            'authors' => Author::select('id', 'first_name', 'last_name')->get(),
        ]);
    }

    public function update(Post $post, CreatePostRequest $request)
    {
        $post->update($request->validated());

        return redirect()->route('blog.show', ['post' => $post->slug])->with('success', "L'article a bien été modifié");
    }

    public function showAuthor(Author $author): View
    {
        return view('blog.author', [
            'author' => $author,
            'posts' => $author->posts()->paginate(5)
        ]);
    }


}
