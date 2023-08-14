<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signup(){
        if(Auth::check()){
            return redirect('/dashboard');
        }else{
            return view('auth.signup');
        }
    }

    public function create(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'account_type' => 'required|string|in:Individual,Business',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Create user
        User::create([
            'name' => $request->name,
            'account_type' => $request->account_type,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            return redirect('/dashboard');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }

    public function loginview(){
        if(Auth::check()){
            return redirect('/dashboard');
        }else{
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            return redirect('/dashboard');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
