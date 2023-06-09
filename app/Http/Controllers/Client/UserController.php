<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    function login()
    {
        $type_login = 'client';
        return view('client.auth.login', compact('type_login'));
    }

    function store(Request $request)
    {
        $credentials = $request->validate(['email' => [], 'password' => [Password::defaults()],]);
        if (Auth::guard('admin')->attempt($credentials)) {
            Auth::guard('web');
        }

        if (Auth::attempt($credentials)) {
                return redirect(url('/'));
        } else {
            return redirect(route('client.login'));
        }
    }

    function create_profile()
    {
        return view('client.auth.profile');
    }

    function store_profile(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::find($id);
        $user->update($data);
        return redirect(url('/'));
    }
function change_password(Request $request, $id){

}
    function logout(Request $request)
    {
        Auth::logout();
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(url('/'));
    }
}
