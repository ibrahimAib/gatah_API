<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginAuthRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'token' => $user->createToken('API Token of ' . $user->name, $user->role == 'admin' ? ['admin'] : ['user'])->plainTextToken,
            'phone' => $user->phone,
            'name' => $user->name
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'logging out successfully'
        ], 200);
    }
    public function auth_test()
    {
        return response()->json(Auth::user()->phone);
    }

    public function update(UpdateUserRequest $request)
    {
        $user_data = $request->validated();
        if (!empty($user_data['password'])) {
            $user_data['password'] = Hash::make($user_data['password']);
        }
        $user = Auth::user();
        $user->update($user_data);
        return response()->json([
            'message' => 'updated successfuly',
            'updated_user' => $user
        ], 201);
    }
}
