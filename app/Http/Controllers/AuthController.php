<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private const TOKEN_NAME = 'user_token';
    private const TOKEN = 'token';
    private const INCORRECT_EMAIL = 'Incorrect email';

    private const VALIDATE_EMAIL = 'required|email';
    private const VALIDATE_PASSWORD = 'required';
    private const VALIDATE_NAME = 'required|string|max:255';

    private const VALIDATE_REGISTER_EMAIL = 'required|email|unique:users,email';
    private const VALIDATE_REGISTER_PASSWORD = 'required|confirmed|min:8';

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            User::EMAIL => self::VALIDATE_EMAIL,
            User::PASSWORD => self::VALIDATE_PASSWORD,
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $token = $user->createToken(self::TOKEN_NAME)->plainTextToken;

            $request->session()->put(self::TOKEN, $token);

            return redirect()->route('tasks.index');
        }

        return back()->withErrors([
            User::EMAIL => self::INCORRECT_EMAIL,
        ]);
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
                User::EMAIL => self::VALIDATE_REGISTER_EMAIL,
                User::PASSWORD => self::VALIDATE_REGISTER_PASSWORD,
                User::NAME => self::VALIDATE_NAME,
        ]);

        $user = User::create([
            User::NAME => $request->name,
            User::EMAIL => $request->email,
            User::PASSWORD => Hash::make($request->password),
        ]);

        Auth::login($user);
        $token = $user->createToken(self::TOKEN_NAME)->plainTextToken;

        $request->session()->put(self::TOKEN, $token);
        return redirect()->route('tasks.index');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect('/');
    }
}
