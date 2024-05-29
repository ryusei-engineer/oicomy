<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\UserController;

class AuthController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        User::create($validated);

        return to_route('login');
    }

    public function login(Request $request){
        $validated = $request->validate([
            // 'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if(\Auth::attempt($validated)){
            $request->session()->regenerate();
            return redirect()->intended('/my_room');
        }
        return back()->withInput()->with('error', 'メールアドレスまたはパスワードが正しくありません');
    }

    public function logout(Request $request)
{
    \Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}
