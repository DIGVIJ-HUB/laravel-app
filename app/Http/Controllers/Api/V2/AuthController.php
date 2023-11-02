<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registration(Request $request)
    {
        // Validation
        $validator = $this->validateRegister($request);
        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->input('password')),
        ]);

        return response()->json([
            'result' => true,
            'message' => 'Registration successful'
        ]);
    }

    public function login(Request $request)
    {
        // Validation
        $validator = $this->validateLogin($request);
        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => $validator->errors()
            ], 400);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('id', Auth::user()->id)->first();
            $token = $user->createToken('API Token')->plainTextToken;
            $user->device_token = $token;
            $user->save();
            return response()->json([
                'result' => true,
                'message' => 'Logged In',
                'access_token' => $token,
                'user'         => [
                    'id'              => $user->id,
                    'role'            => $user->role,
                    'name'            => $user->name,
                    'email'           => $user->email,
                ],
            ]);
        }

        return response()->json([
            'result' => false,
            'message' => 'Invalid credentials'
        ], 400);
    }

    public function logout()
    {
        $user = request()->user();;
        $user->device_token = null; // Clear the device token
        $user->save();

        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json([
            'result' => true,
            'message' => 'Log out successful',
        ]);
    }

    private function validateRegister(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'        => 'required|alpha',
            'email'        => 'required|email|unique:users',
            'password'     => 'required|min:4|confirmed',
        ]);
        return $validate;
    }

    private function validateLogin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email'        => 'required|email',
            'password'     => 'required',
        ]);
        return $validate;
    }
}
