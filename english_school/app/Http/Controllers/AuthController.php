<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\CustomUser;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $user = DB::select('SELECT * FROM CUSTOM_USERS WHERE EMAIL = ?', [$request->email]);

        if($user){
            return redirect('/register')->with('msg', 'Este email já está em uso.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:custom_users',
            'password' => 'required|string|min:8',
        ]);


        $user = new CustomUser;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->school_id = null;
        $user->admin = true;
        $user->save();
        
        return redirect('/register/school')->with('user', $user);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = DB::table('custom_users')
            ->where('email', $credentials['email'])
            ->first();

        if(!$user) {
            return redirect('/login')->with('msg', 'Email ou senha inválidos!');
        }

        if($user->school_id == null){

            return redirect('/register/school')->with('user', $user);

        }

        if(Auth::guard('web')->attempt($credentials)) 
        {
            return redirect('/tutors');
        }

        return redirect('/login')->with('msg', 'Email ou senha inválidos!');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
