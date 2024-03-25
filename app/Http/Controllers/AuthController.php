<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequeste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequeste $request)
    {
        $userData = $request->validated();
        $userData["password"] = Hash::make($userData["password"]);
        
        try {
            $user = User::create($userData);
            $token = $user->createToken("auth_token")->plainTextToken;
    
            return response()->json([
                "message" => "User created successfully",
                "user" => $user,
                "token" => $token
            ]);
        } catch (\Exception $e) {
            return response()->json(["message" => "User registration failed", "error" => $e->getMessage()], 500);
        }
    }



    
    





}
