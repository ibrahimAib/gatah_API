<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginAuthRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function error_message()
    {
        return response()->json([
            'message' => 'unAutharaiz'
        ], 401);
    }
    public function register()
    {
        // 
    }
    public function login(loginAuthRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'phone or password not correct!'
            ], 401);
        }

        // لو نجح تسجيل الدخول، ممكن ترجع التوكن مثلاً
        $user = Auth::user();

        return response()->json([
            'message' => 'Login successful',
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken,
            'phone' => $user->phone
        ]);
    }

    public function logout()
    {
        // 
    }
    public function auth_test()
    {
        return response()->json(Auth::user()->phone);
    }
}
