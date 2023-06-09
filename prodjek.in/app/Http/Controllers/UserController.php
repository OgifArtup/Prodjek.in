<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function manualLogin(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email|regex:[@gmail.com$]',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = User::where('email', '=', $request->email)->exists();
            return redirect()->intended('/home');
        }     

        return back()->with('errorLogin', 'Email or Password is invalid!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
