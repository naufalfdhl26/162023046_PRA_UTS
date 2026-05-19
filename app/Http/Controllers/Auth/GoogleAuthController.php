<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['oauth' => 'Gagal terhubung ke Google.']);
        }

        if (! $googleUser || ! $googleUser->getEmail()) {
            return redirect()->route('login')->withErrors(['oauth' => 'Google tidak mengembalikan email.']);
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if (! $user) {
            $user = User::create([
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Google User',
                'email' => $googleUser->getEmail(),
                'role' => 'buyer',
                'password' => Hash::make(Str::random(16)),
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
}
