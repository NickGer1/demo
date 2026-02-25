<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:190', 'unique:users,email'],
            'login' => ['required', 'string', 'min:6', 'max:50', 'alpha_dash', 'unique:users,login'],
            'password' => ['required', Password::min(8)],
        ], [
            'login.unique' => 'Этот логин уже занят.',
            'email.unique' => 'Этот email уже зарегистрирован',
            'login.min' => 'Логин должен содержать минимум 6 символов',
            'password.min' => 'Пароль должен содержать минимум 8 символов',
        ]);

        $user = User::create([
            'login' => $validated['login'],
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
        ]);

        return redirect()->route('register')->with('register_success', true);
    }
}
