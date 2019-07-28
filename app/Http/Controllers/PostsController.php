<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use GrahamCampbell\Markdown\Facades\Markdown;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index()
    {
        return Post::filter(request()->all())->with('user')->simplePaginate(30)->appends(request()->except('page'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => ''
        ]);
        
        $thumbnailPath = $data['thumbnail']->store('uploads', 'public');
        $thumbnail = Image::make(public_path("storage/" . $thumbnailPath))->fit(410, 610);
        $thumbnail->save();

        $data['thumbnail'] = $thumbnailPath;

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

    public function destroy(Post $post)
    {
        if (auth()->user()->can('update', $post)) {
            $post->delete();
        } else {
            return abort(403);
        }

        return redirect()->route('users.show', auth()->user()->id);
    }

    public function toggleLike(Post $post)
    {
        if (auth()->user()->can('like', $post)) {
            auth()->user()->toggleLike($post);

            return response()->json([
                'status' => 200,
                'hasLiked' => auth()->user()->hasLiked($post),
                'likes' => $post->likers->count()
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'Cannot like this post'
            ]);
        }  
    }
}
