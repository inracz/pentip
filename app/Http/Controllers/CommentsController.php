<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
        $data = request()->validate([
            'body' => 'required'
        ]);

        $data['user_id'] = auth()->user()->id;

        Post::find($post->id)->comments()->create($data);

        return redirect()->route('posts.show', $post->id);
    }
}
