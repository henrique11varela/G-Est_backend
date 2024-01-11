<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    function login(LoginRequest $request)
    {
        try {
            $user = User::Where("email", $request->email)->first();
            if (!$user) {
                throw ValidationException::withMessages(["email" => "email invalid"]);
            }
            if (!Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages(["password" => "password invalid"]);
            }
            $user->tokens()->delete();
            $token = $user->createToken($request->password)->plainTextToken;
            $cookie = cookie('bearer_token', $token, 60 * 24);
            return response()->json(['token' => $token], 200)->cookie($cookie);
        } catch (\Exception $e) {
            return response()->json(array('message' => $e->getMessage()), $e->status || 500);
        }
    }

    function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            $cookie = Cookie::forget('bearer_token');
            return response()->json(['message' => 'Logged out'], 200)->cookie($cookie);
        } catch (\Exception $e) {
            return response()->json(array('message' => $e->getMessage()), $e->status || 500);
        }
    }
}
