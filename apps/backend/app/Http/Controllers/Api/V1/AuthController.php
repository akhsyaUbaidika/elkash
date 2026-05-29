<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
                'errors' => [],
            ], 401);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        $user->update([
            'last_login_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login success',
            'data' => [
                'user' => $user,
                'roles' => $user->getRoleNames(),
            ],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logout success',
            'data' => null,
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Authenticated user',
            'data' => $request->user(),
        ]);
    }
}