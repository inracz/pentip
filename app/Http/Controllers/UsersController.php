<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * User's profile
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show form for editing the user's profile
     */
    public function edit()
    {
        return view('users.edit', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Save the edit form
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
