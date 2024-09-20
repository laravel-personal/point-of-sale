<?php

namespace App\Http\Controllers;

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
    function UserRegistration(Request $request)
    {
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName'  => $request->lastName,
            'email'     => $request->email,
            'mobile'    => $request->mobile,
            'password'  => $request->password
        ]);
        return response()->json($user);
    }
}
