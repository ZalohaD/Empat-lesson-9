<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\error;


class AuthContoller extends Controller
{
    public function login(Request $request){
        $validation = User::where('email', $request->email)->first();

        if (!$validation):
            return response()->json([
                'success' => false,
                'data' => [
                    'error' => 'User not exist'
                ]
            ]);

        endif;

        $validatePassword = Hash::check($request->password, $validation->password);

        if (!$validatePassword):
            return response()->json( [
                'success' => false,
                'data' => [
                        'error' => 'Password incorrect'
                    ]
             ]);
        endif;

        $userToken = $validation->createToken('default')->plainTextToken;


        return response()->json( [
            'success' => true,
            'data' => [
               'token' => $userToken
            ]
        ]);
    }
    public function register(LoginRequest $request) {
        $emailValidation = User::where('email', $request->email)->exists();

        if ($emailValidation) {
            return response()->json([
                'success' => false,
                'error' => 'User already exists'
            ], 400);
        };

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'email_verified_at' => now(),
            'password'=> bcrypt($request->password),
        ]);

        $token = $user->createToken('default')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token
            ]
        ]);
    }
}
