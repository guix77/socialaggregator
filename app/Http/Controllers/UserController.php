<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
    }

    public function new()
    {
        return view('users.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('ok', __('The user has been created.'));
    }

    public function edit(User $user)
    {
        $this->authorize('manage', $user);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('manage', $user);
        $request->validate([
            'github_user_name' => 'nullable|string',
            'drupal_user_id' => 'nullable|numeric',
            'twitter_user_id' => 'nullable|numeric',
            'linkedin_user_id' => 'nullable|numeric',
        ]);
        $user->github_user_name = $request->github_user_name;
        $user->drupal_user_id = $request->drupal_user_id;
        $user->save();
        return back()->with('ok', __('The user has been updated.'));
    }

    public function destroy(User $user)
    {
        $this->authorize('manage', $user);
        $user->delete();
        return response()->json();
    }
}
