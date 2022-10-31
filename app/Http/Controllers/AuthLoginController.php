<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Exception;

class AuthLoginController extends Controller
{
    protected function _registerOrLoginUser($data)
    {
        try {
            $user = User::where('email', $data->email)->first();

            if ($user) {
                Auth::login($user);
            } else {
                if (!config('config.restrict_by_email') or Str::endsWith($data->email, '@' . config('config.email-domain'))) {
                    $user = User::create([
                        'name' => $data->name,
                        'email' => $data->email,
                        'password' => Hash::make(Str::random(24)),
                    ]);
                    Auth::login($user);
                } else {
                    return redirect('/')->with('error', 'You are not allowed to login');
                }
            }
            return redirect('/');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        return $this->_registerOrLoginUser($user);
    }
}
