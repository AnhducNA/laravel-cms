<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthenticatedSessionController extends Controller
{
//    admin
    function create()
    {
        return view('admin.auth.login');
    }

    function store(Request $request)
    {
//        dd($request->all());
        $credentials = $request->validate(['email' => [], 'password' => [Password::defaults()],]);

        if (Auth::attempt($credentials)) {
            if(!empty($request->get('type_login'))){
                $type_login=!empty($request->get('type_login'));
                if($type_login== 'client'){
                    return redirect(url('/'));
                } else{
                    return redirect(route('admin.dashboard'));
                }
            }else{
                return redirect(route('admin.dashboard'));
            }
        } else {
            return redirect(route('admin.login'));
        }
    }

    function destroy(Request $request)
    {
        Auth::logout();
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin/login');
    }

}
