<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * User Registration
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function UserRegistration(Request $request) {
        try {
            User::create([
                'firstName' => $request->firstName,
                'lastName'  => $request->lastName,
                'email'     => $request->email,
                'mobile'    => $request->mobile,
                'password'  => $request->password
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'User Registered Successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->errorInfo[2],
            ]);
        }
    }

    /**
     * User Login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function UserLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->password == $request->password) {
                $token = JWTToken::generateToken($user->email);
                return response()->json([
                    'status' => 200,
                    'message' => 'User Logged In Successfully',
                    'token' => $token
                ], 200);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Password',
                ], 401);
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found',
            ], 404);
        }
    }
}
