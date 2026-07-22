<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirebaseLoginController extends Controller
{
    public function login(Request $request)
    {
        // Middleware 'firebase.auth' sudah memverifikasi token
        // dan meng-set user sementara lewat auth()->setUser($user).
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Autentikasi gagal'], 401);
        }

        Auth::login($user);

        $request->session()->regenerate();

        return response()->json(['redirect' => route('dashboard')]);
    }
}