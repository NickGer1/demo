<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Введите логин.',
            'password.required' => 'Введите пароль.',
        ]);

        if (Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['password']], false)) {
            $request->session()->regenerate();

            $default = auth()->user()->is_admin
                ? route('admin.requests.index') // страница всех заявок для админа
                : route('requests.index');      // страница заявок пользователя

            return redirect()->intended($default);
        }

        return back()->withErrors(['login' => 'Неверный логин или пароль.'])->onlyInput('login');
    }

    public function destroy(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
