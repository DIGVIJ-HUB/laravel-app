<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('./frontend/register');
    }

    public function registration(Request $request)
    {
        // Validation
        $validator = $this->validateRegister($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->input('password')),
        ]);

        return redirect('/');
    }

    public function login(Request $request)
    {
        // Validation
        $validator = $this->validateLogin($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('id', Auth::user()->id)->first();
            $token = $user->createToken('API Token')->plainTextToken;
            $user->device_token = $token;
            $user->save();
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('admin/dashboard');
            } else {
                return redirect()->intended('home');
            }
        }

        Session::flash('warning', 'Invalid credentials');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->device_token = null; // Clear the device token
        $user->save();
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    private function validateRegister(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'        => 'required',
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
