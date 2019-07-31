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
     * Get all the latest posts of user's subscriptions
     * 
     * @return  \Illuminate\Pagination\Paginator|\Illuminate\View\View Paginated posts
     */
    public function feed()
    {
        auth()->user()->unreadNotifications->markAsRead();   
        return view('posts.feed');
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
     * Get all the bookmarks
     * 
     * @return  \Illuminate\View\View Paginated posts
     */
    public function bookmarks()
    {
        return view('posts.bookmarks');
    }
}
