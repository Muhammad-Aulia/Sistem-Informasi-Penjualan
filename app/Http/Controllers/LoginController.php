<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\facades\Auth;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function autentichate(Request $request)
    {
        $data = [
            'email'         => $request->input('email'),
            'password'      => $request->input('password')
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            // login success
            return redirect()->route('admin');
        } else {
            // login fail
            Session::flash('message', 'Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
