<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    // ログインフォームの表示
    public function showForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // ユーザー認証
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/dashboard'); // ログイン後のリダイレクト先
        }

        return back()->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
    }
}