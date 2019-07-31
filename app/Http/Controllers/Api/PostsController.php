<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    /**
     * Get filtered posts and paginate
     * 
     * @return \Illuminate\Pagination\Paginator Paginated posts
     */
    public function index()
    {
        return PostResource::collection(Post::filter(request()->all())->latest()->with('user')->simplePaginate(30)->appends(request()->except('page')));
    }

    /**
     * Get all the latest posts of user's subscriptions
     * 
     * @return  \Illuminate\Pagination\Paginator|\Illuminate\View\View Paginated posts
     */
    public function feed(Request $request)
    {
        $users = auth()->user()->subscriptions()->pluck('id')->toArray(); // Get IDs of user's subscriptions   
        return PostResource::collection(Post::whereIn('user_id', $users)->filter(request()->all())->latest()->with('user')->simplePaginate(30)->appends(request()->except('page')));
    }

    /**
     * Get all the latest posts of user's subscriptions
     * 
     * @return  \Illuminate\Pagination\Paginator|\Illuminate\View\View Paginated posts
     */
    public function bookmarks(Request $request)
    {
        $bookmarks = auth()->user()->bookmarks(Post::class);
        return PostResource::collection($bookmarks->filter(request()->all())->latest()->with('user')->simplePaginate(30)->appends(request()->except('page')));
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
     * Toggle bookmark
     * 
     * @param App\Post The post user wants to bookmark
     * @return string An API JSON response
     */
    public function toggleBookmark(Post $post)
    {
        auth()->user()->toggleBookmark($post);

        return response()->json([
            'status' => 200,
            'hasBookmarked' => auth()->user()->hasBookmarked($post)
        ]);
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
            return response()->json([
                'status' => 200,
                'message' => 'Deleted'
            ]);
        }
        
        return abort(403); // Otherwise send exception
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
}
