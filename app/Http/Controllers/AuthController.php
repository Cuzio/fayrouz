<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function registerUser(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|string|min:8',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $formFields = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ];

        $user = User::create($formFields);

        if($user){
            Auth::login($user);
            return redirect('/')->with('success', 'Registration was successful');
        }else{
            return redirect()->back()->with('error', 'An error has occurred, Registration was not successful');
        }
    }

    public function loginUser(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $user =User::where('email', strtolower($request->input('email')))->first();

        // Check if user exists and password matches
        if(!$user || !Hash::check($request->input('password'), $user->password)){
            return redirect()->back()->withInput()->with("error", "Invalid credentials");
        }

        (auth()->login($user));

        return redirect('/')->with('success', 'Login Successfully');
        
    }

    public function logout(Request $request){
        auth()->logout();
        // Auth::logout(); (above is the same as this line).
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/allposts')->with('success', 'See you sonn!!!');
    }

}