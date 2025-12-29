<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthorizationController extends Controller
{
    public function handleAuthentication(Request $request)
    {
        $mode = $request->input('auth_mode');

        if ($mode === 'signup') {
            return $this->register($request);
        }
        elseif ($mode === 'login') {
            return $this->login($request);
        }
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $name = explode('@', $validatedData['email'])[0];

        $user = User::create([
            'name' => $name,
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'active' => true, // Set the user as active upon registration
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registration successful');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Login successful');
        }
        else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/dashboard');

    }
}
