<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
  
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
 
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id'=> $googleUser->id,
            'username' => $googleUser->name,
            'password' => encrypt('123456dummy')
        ]);
    
        Auth::login($user);
    
        return redirect('/home');
    }
}

