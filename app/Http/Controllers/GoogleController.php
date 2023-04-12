<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended('/');

            } else {
                $email_exit = User::where('email', $user->email)->first();
                if($email_exit){
                    Auth::login($email_exit);
                }else{
                    $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'google_id' => $user->id, 'password' => encrypt('123456dummy')]);
                    Auth::login($newUser);
                }


                return redirect()->intended('/');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}