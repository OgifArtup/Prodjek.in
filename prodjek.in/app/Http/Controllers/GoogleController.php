<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialites;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try{
            $user = Socialite::drive('google')->user();
            $findUser = User::where('google_id', $user->getId())->first();
            if($findUser){
                Auth::login($findUser);
                return redirect()->intended('home');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'username' => $user->email,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => $user->bcrypt('123456')
                ]);
                Auth::login($newUser);
                return redirect()->intended('home');
            }
        }catch (\Throwable $th){

        }
    }
}
