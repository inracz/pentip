<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post)
    {
        $data = request()->validate([
            'body' => 'required'
        ]);

        auth()->user()->comment($post, $data['body']);

        return redirect()->route('posts.show', $post->id);
    }
}
