<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Post;
use App\Http\Resources\CommentResource;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get filtered comments and paginate
     * 
     * @return \Illuminate\Pagination\Paginator Paginated comments
     */
    public function index()
    {
        return CommentResource::collection(Comment::filterAndPaginate());
    }

    /**
     * Store a new comment
     * 
     * @param App\Post The post user is commenting on
     * @return \Illuminate\Http\RedirectResponse Redirect to the post user is commenting on
     */
    public function store(Post $post)
    {
        $data = request()->validate([
            'body' => 'required'
        ]);

        auth()->user()->comment($post, $data['body']);

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Toggle like/dislike on a comment
     * 
     * @param App\Comment The comment user wants to like/dislike
     * @return string An API JSON response or an error message
     */
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

