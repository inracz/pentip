<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use GrahamCampbell\Markdown\Facades\Markdown;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required'
        ]);

        $post = auth()->user()->posts()->create($data);

        return redirect()->route('posts.show', $post->id);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show(Post $post)
    {
        $post->content = Markdown::convertToHTML($post->content);
        return view('posts.show', compact('post'));
    }
}
