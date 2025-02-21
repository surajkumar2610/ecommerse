<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(){
        return view('auth.login');
    }

    function loginPost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $credentials=$request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
        }
        return redirect("login")->with("error", "Invalid email or password");
    }
    function register(){
        return view('auth.register');
    }
    function registerPost(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            return redirect()->intended(route("login"))->with("success", "You have beend registered");
        }
        return redirect(route("register"))->with("error", "Somethig went wrong");
    }

    function logout(){
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
