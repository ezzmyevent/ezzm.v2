<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\User;
use App\Models\MasterSettings;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
        * Instantiate a new controller instance.
        *
        * @return void
    */

    public function __construct()
    {
        
    }

    public function login()
    {
        return view('admin.login')->with('page_title', 'Login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'Username is required.',
                'password.required' => 'Password is required.'
            ]
        );
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('adminhome')->withSuccess('Signed in');
        }
        
        return back()->withErrors([
            'credentials' => 'Email or Password is incorrect.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin-login');
    }

    
}
