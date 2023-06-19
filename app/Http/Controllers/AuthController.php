<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('admin.auth.register');
    }
    public function login()
    {
        return view('admin.auth.login');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function registrationForm(Request $request)
    {

        $storeData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        $users = DB::table('users')->insert([
            'name' => $storeData['name'],
            'email' => $storeData['email'],
            'phone' => $storeData['phone'],
            'password' => Hash::make($storeData['password']),
        ]);

        if($users){
            return redirect('/login');
        }

    }
    public function loginForm(Request $request)
    {
        if(Auth::attempt( $request->only('email','password'))){

            return redirect('/');
        }



    }
    public function logout(Request $request){

        Auth::guard('web')->logout();

        return redirect('/');
    }

}