<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id', $googleUser->getId())->first();
        if($user){
            $user->google_id = $googleUser->id;
            $user->save();
            Auth::login($user);
            return redirect()->intended('home');
        }else{
            $newUser = User::create([
                'name' => $googleUser->name,
                'username' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => bcrypt('123456dummy')
            ]);
            Auth::login($newUser);
            return redirect()->route('firstTimeLogin');
        }
    }

    public function firstTimeLogin(){
        if(!Hash::check('123456dummy', Auth::user()->password, []))
        {
            return redirect()->route('viewHome');
        }
        return view('firstTimeLogin');
    }

    public function makePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        $user = User::find(Auth::user()->id);
        $user -> update([
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('viewHome');
    }
}

