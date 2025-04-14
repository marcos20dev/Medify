<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login()
    {
        return view('vistas.cita.login.login');
    }

    public function verificacion(Request $request)
    {
        $request->validate([
            'Numdoc' => 'required|string|max:8',
            'password' => 'required|string', // Contraseña debe tener mínimo 8 caracteres
        ]);
        $numdoc = $request->Numdoc;
        if (filter_var($numdoc, FILTER_VALIDATE_EMAIL)) {
            return redirect()->route('login')->withErrors(['message' => 'Por favor ingresa tu DNI, no un correo electrónico.']);
        }
        if (!preg_match('/^[0-9]{8}$/', $numdoc)) {
            return redirect()->route('login')->withErrors(['message' => 'Por favor ingresa un DNI válido de 8 dígitos.']);
        }
        $credentials = [
            'Numdoc' => $numdoc,
            'password' => $request->password,
        ];
        $remember = $request->has('recordarme');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('menu'));
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Credenciales incorrectas']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
