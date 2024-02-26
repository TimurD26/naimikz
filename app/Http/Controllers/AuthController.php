<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'password' => 'required|min:6|max:20|alpha_num',
            'email' => 'required|email|min:6|max:50',
            'isClient'=>'required|min:0|max:5',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->password = Hash::make($validated['password']);
        $user->email = $validated['email'];
        $user->isClient = $validated['isClient'];
        $user->save();

        // Generate a token for the registered user
        $token = JWTAuth::fromUser($user);

        return response()->json(['user' => $user, 'access_token' => $token], 200);
    }

    public function login(Request $request)
    {
            $credentials = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
    
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid login or password'], 401);
            }
    
            return response()->json(['access_token' => $token]);
    }
    
    public function logout(Request $request)
    {
            // Invalidate the token by adding it to the blacklist
            $token = $request->bearerToken();
            JWTAuth::parseToken()->invalidate($token);
    
            return response()->json(['message' => 'Logout successful']);
    }
    
    public function me(Request $request)
    {
            $user = JWTAuth::user();
            return response()->json($user);
    }
   
}

