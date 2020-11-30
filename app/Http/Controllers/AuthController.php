<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $successStatus = 200;

    
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required', 
            'last_name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required|min:6'
        ]);


        $user = User::create([
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name, 
            'email' => $request->email, 
            'password' => bcrypt($request->password)
        ]);

        return response()->json($user);
       

    }
    

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email', 
            'password' => 'required'
        ]);
    
        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
            $user = Auth::user();
    
            $token = $user->createToken($user->email.'-'.now());
    
            return response()->json([
                'token' => $token->accessToken
            
            ]);

        }
    }

    public function logout (Request $request) {
            $token = $request->user()->token();
            $token->revoke();
            $response = ['message' => 'You have been successfully logged out!'];
            return response($response, 200);
        }

    public function profile()
        {
            $user = Auth::user();
            return response()->json(['success' => $user], $this->successStatus);
        }
    

        public function forgotpassword(){

        }
    }

    

