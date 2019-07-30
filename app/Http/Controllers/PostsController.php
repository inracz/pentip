<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use GrahamCampbell\Markdown\Facades\Markdown;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\PostResource;

class PostsController extends Controller
{
    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index', 'pdf']);
    }

    /**
     * Get filtered posts and paginate
     * 
     * @return \Illuminate\Pagination\Paginator Paginated posts
     */
    public function index()
    {
        return PostResource::collection(Post::latest()->filter(request()->all())->with('user')->simplePaginate(30)->appends(request()->except('page')));
    }

    /**
     * Get all the latest posts of user's subscriptions
     * 
     * @return  \Illuminate\Pagination\Paginator|\Illuminate\View\View Paginated posts
     */
    public function feed()
    {
        auth()->user()->unreadNotifications->markAsRead();
        
        $users = auth()->user()->subscriptions()->pluck('id')->toArray(); // Get IDs of user's subscriptions
        
        if (request()->ajax()) { // If the request is AJAX
            return PostResource::collection(Post::whereIn('user_id', $users)->latest()->with('user')->simplePaginate(30)->appends(request()->except('page')));
        }
    
        return view('posts.feed'); // Otherwise return a view
    }

    /**
     * Store a new post in the database
     * 
     * @return \Illuminate\Http\RedirectResponse Redirect to the newly created post
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => 'image'
        ]);
        
        // Upload the thumbnail to the server and resize
        if (isset($data['thumbnail'])) {
            $thumbnailPath = $data['thumbnail']->store('uploads', 'public');
            $thumbnail = Image::make(public_path("storage/" . $thumbnailPath))->fit(410, 610);
            $thumbnail->save();

            $data['thumbnail'] = $thumbnailPath;
        }

        $post = auth()->user()->posts()->create($data);

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Update a post in the database
     * 
     * @return \Illuminate\Http\RedirectResponse Redirect to the newly created post
     */
    public function update(Request $request, Post $post)
    {
        if (!auth()->user()->can('update', $post)) {
            return abort(403);
        }

        $data = $request->validate([
            'title' => '',
            'description' => '',
            'content' => '',
            'thumbnail' => 'image'
        ]);
        
        // Upload the thumbnail to the server and resize
        if (isset($data['thumbnail'])) {
            $thumbnailPath = $data['thumbnail']->store('uploads', 'public');
            $thumbnail = Image::make(public_path("storage/" . $thumbnailPath))->fit(410, 610);
            $thumbnail->save();

            $data['thumbnail'] = $thumbnailPath;
        }

        $post->update($data);

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Get the form for creating a new post
     * 
     * @return \Illuminate\View\View Form for creating a new post
     */
    public function create()
    {
        return view('posts.edit');
    }

    /**
     * Get the form for editing a new post
     * 
     * @return \Illuminate\View\View Form for creating a new post
     */
    public function edit(Post $post)
    {
        if (!auth()->user()->can('update', $post)) {
            return abort(403);
        }
        
        return view('posts.edit', compact('post'));
    }

    /**
     * Show one post by ID
     * 
     * @param \App\Post The post you want to show
     * @return \Illuminate\View\View Post
     */
    public function show(Post $post)
    {
        views($post)->record();
        
        $post->content = Markdown::convertToHTML($post->content);
        return view('posts.show', compact('post'));
    }

    /**
     * Delete one post by ID
     * 
     * @param \App\Post The post you want to delete
     * @return \Illuminate\Http\RedirectResponse Redirect to a user's profile
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->can('update', $post)) { // If user can update a post
            $post->delete();
        } else {
            return abort(403); // Otherwise send exception
        }

        return redirect()->route('users.show', auth()->user()->id);
    }

    /**
     * Toggle like/dislike on a post
     * 
     * @param App\Post The post user wants to like/dislike
     * @return string An API JSON response or an error message
     */
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

    /**
     * Download post as a PDF file
     * 
     * @param App\Post Post
     * @return string PDF file
     */
    public function pdf(Post $post)
    {
        return $post->getPdf();
    }
}
