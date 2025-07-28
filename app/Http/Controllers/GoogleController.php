<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectTOGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {

        try {

            $user =  Socialite::driver('google')->stateless()->user();

            $findUser = User::where('google_id', $user->id)->first();

            if ($findUser) {
                 Auth::login($findUser);
              
                return redirect()->intended('dashboard')
                    ->with('success', 'Bienvenue '  .  Auth::user()->name . '!');
            } else {
                $newUser = User::updateOrCreate(
                    [
                        'email' => $user->email,
                    ],
                    [
                        'google_id' => $user->id,
                        'password' => Hash::make(Str::random(10)),
                    ]);
                 Auth::login($newUser);
              
                return redirect()->intended('dashboard')
                    ->with('success', 'Bienvenue' . Auth::user()->lastname . '!');
            }
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),

            ]);
        }
    }
}
