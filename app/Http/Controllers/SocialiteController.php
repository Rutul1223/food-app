<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        // Check if user exists
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            // Log the user in
            Auth::login($existingUser, true);
        } else {
            // Create a new user
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('password'), // You may want to handle this more securely
            ]);

            Auth::login($newUser, true);
        }

        return redirect()->intended('/welcome'); // Redirect to your intended page
    }
}
