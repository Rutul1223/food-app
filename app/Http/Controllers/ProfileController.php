<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user(); // Get the authenticated user

    // Handle image upload if a new image is uploaded
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // Store the new image in the 'public/images' directory and get the path
        $imagePath = $request->file('image')->store('images', 'public');

        // Update the user's image path
        $user->image = $imagePath;
    }

    // Update the user's address and other fields
    $user->fill($request->validated() + [
        'address' => $request->address,
    ]);

    // Check if the email is updated and reset email verification if necessary
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Save the updated user information
    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
