<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterBuyerRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthenticationController extends Controller
{
    //signup seller
    public function signupSeller(RegisterRequest $request)
    {
        $data = $request->all();

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo_path = $request->file('photo');
            $photo_name = $photo_path->hashName();
            $photo_path->storeAs('public/sellers', $photo_name);
            $photo = $photo_name;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'country' => $data['country'],
            'city' => $data['city'],
            'district' => $data['district'],
            'postal_code' => $data['postal_code'],
            'photo' => $photo,
        ]);

        // $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => $user
        ], 201);
    }

    //login
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('token_auth')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
    }

    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'logged out and token revoked'
        ], 204);
    }

    //register buyer
    public function signupBuyer (RegisterBuyerRequest $request)
    {
        $payload = $request->all();

        $user = User::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'username' => $payload['username'],
            'password' => Hash::make($payload['password']),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => $user
        ], 201);
    }
}
