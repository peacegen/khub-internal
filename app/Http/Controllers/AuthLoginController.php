<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthLoginController extends Controller
{
    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', $data->email)->first();

        if ($user) {
            Auth::login($user);
        } else {
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make(Str::random(24)),
            ]);

            $user->assignRole('user');

            Auth::login($user);
        }
    }
}
