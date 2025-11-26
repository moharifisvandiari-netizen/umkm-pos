<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $user = User::where('username',$request->username)
                    ->where('role','admin')
                    ->first();

        if($user && Hash::check($request->password,$user->password)){
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['username'=>'Username atau password salah.']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
