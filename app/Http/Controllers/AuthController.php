<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as AuthUser;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    public function register(AuthRequest $request) {
        $data = $request->validated();
        
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $token = AuthUser::login($user);

        return response()->json([
            'status_code' => 200,
            'message' => 'User registration is successfull',
            'data' => [
                'token' => $token
            ]
        ], 201);
    }

    public function login(AuthRequest $request) {
        $credentials = request(['email', 'password']);

        if(!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Login is successfull',
            'data' => [
                'token' => $token
            ]
        ], 200);
    }
}
