<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * User's profile
     * 
     * @param \App\User User
     * @return \Illuminate\View\View User's profile view
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show form for editing the user's profile
     * 
     * @return  \Illuminate\View\View Edit form
     */
    public function edit()
    {
        return view('users.edit', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Save the edit form
     * 
     * @return \Illuminate\Http\RedirectResponse Redirect to the user's profile
     */
    public function update()
    {
        $validated = request()->validate([
            'description' => ''
        ]);

        auth()->user()->profile()->update($validated);

        return redirect()->route('users.show', auth()->user()->id);
    }

    /**
     * Subscribe to a user
     * 
     * @param \App\User The user you want to subscribe to
     * @return string API JSON response
     */
    public function toggleSubscribe(User $user)
    {
        auth()->user()->toggleSubscribe($user);

        return response()->json([
            'status' => 200,
            'isSubscribed' => auth()->user()->hasSubscribed($user)
        ]);
    }
}
