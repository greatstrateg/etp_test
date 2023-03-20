<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //check login and password from form
    public function auth(Request $request)
    {
        Log::info($request->all());

        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return "success";
        }
        return "error";
    }

    //check authentication user
    public function authCheck() {
        if(Auth::check()) {
            return "success";
        }
        else {
            return "no";
        }
    }

    //logout user
    public function authLogout() {
        Session::flush();
        Auth::logout();

        return redirect(route('home'));
    }
}
