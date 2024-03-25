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

    public function login(LoginRequest $request){

        try{
            $userRequest = $request->only("email","password");
            $user = User::where("email",$userRequest["email"])->first();

            if(!$user || ! Hash::check($userRequest["password"],$user->password))
            {
                return response()->json(["message"=>"unauthorized"]);
            }
            $token = $user->createToken("auth_token")->plainTextToken;

            return response()->json([
                "message" => "Logged in successfully",
                "token" => $token
            ]);
            
        }catch (\Exception $e) {
            return response()->json(["message" => "User registration failed", "error" => $e->getMessage()], 500);
        }













    }

    
    





}
