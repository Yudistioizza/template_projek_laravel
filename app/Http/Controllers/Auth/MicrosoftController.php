<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftController extends Controller
{
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback()
    {
        $microsoftUser = Socialite::driver('microsoft')->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $microsoftUser->getEmail()],
            ['name' => $microsoftUser->getName()]
        );

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }
}