<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class VerifyFirebaseToken
{
    protected FirebaseAuth $auth;

    public function __construct()
    {
        $this->auth = app('firebase.auth');
    }

    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token tidak ditemukan'], 401);
        }

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($token);
            $uid = $verifiedIdToken->claims()->get('sub');
            $email = $verifiedIdToken->claims()->get('email');

            $user = User::where('email', $email)->first();

            if ($user) {
                // User lama sudah ada, tinggal link firebase_uid-nya
                if (empty($user->firebase_uid)) {
                    $user->firebase_uid = $uid;
                    $user->save();
                }
            } else {
                // User baru, belum pernah ada di database
                $user = User::create([
                    'firebase_uid' => $uid,
                    'email' => $email,
                    'name' => $email,
                ]);
            }

            auth()->setUser($user);
        } catch (FailedToVerifyToken $e) {
            \Log::error('Firebase token verify failed: ' . $e->getMessage());
            return response()->json(['message' => 'Token tidak valid'], 401);
        }

        return $next($request);
    }


}