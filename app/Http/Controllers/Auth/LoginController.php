<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('backend.auth.login');
    }

    public function postLogin(Request $request)
    {
        try {
            
            $request->validate([
                "email" => "required",
                "password" => "required" 
            ]);

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->back()->with('error', 'Email atau password yang Anda masukan salah atau tidak ada.')->withInput();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
