<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthenticatedSessionController extends Controller
{
    function create()
    {
        return view('admin.auth.login');
    }

    function store(Request $request)
    {
        $credentials = $request->validate(['email' => [], 'password' => [Password::defaults()],]);

        if (Auth::attempt($credentials)) {
            return redirect(route('admin.dashboard'));
        } else {
            return redirect(route('admin.login'));
        }

    }

    function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin/login');
    }

}
