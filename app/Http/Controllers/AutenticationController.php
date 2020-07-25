<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutenticationController extends Controller
{
    public function signin(Request $request)
    {
        if (!Auth::check())
            return view('login.index');
        else
            return redirect('/home');
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return redirect()->back()->withErrors('Email and/or password incorrenct.');
        }

        return redirect('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/signin');
    }

    public function createAcc(Request $request)
    {
        if (Auth::check())
            return redirect('/home');
        else
            return view('login.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['email', 'password', 'name']);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return redirect('/home');
    }
}
