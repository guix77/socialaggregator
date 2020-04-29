<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
    }

    public function edit(User $user)
    {
        $this->authorize('manage', $user);
        return view('profile.edit', compact('user'));
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
        return back()->with('ok', __('The profile has been successfully updated.'));
    }

    public function destroy(User $user)
    {
        $this->authorize('manage', $user);
        $user->delete();
        return response()->json();
    }
}
