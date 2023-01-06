<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage(Request $request)
    {
        if (auth('admin')->user()) {
            return redirect(route('dashboard'));
        }
        return view('login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->has('remember'))) {

            return redirect(route('dashboard'))
                ->withSuccess('You have Successfully logged in');
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'Sorry! You have entered invalid credentials']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
