<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
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

    public function toggleLike(Comment $comment)
    {
        if (auth()->user()->can('like', $comment)) {
            auth()->user()->toggleLike($comment);

            return response()->json([
                'status' => 200,
                'hasLiked' => auth()->user()->hasLiked($comment),
                'likes' => $comment->likers->count()
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'Cannot like this comment'
            ]);
        }  
    }
}
