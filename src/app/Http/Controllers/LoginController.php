<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Auth;

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
            return response()->json(['token' => $token], 200);
        } catch (\Exception $e) {
            return response()->json(array('message' => $e->getMessage()), 401);
        }
    }

    function logout(Request $request)
    {

    }
}
