<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin(){
        return view('auth.admin.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'exists:admins,email'],
            'password' => ['required'],
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            session()->flash('success', "welcome to owner");
            return redirect()->route('admin.dashboard');
            // return view('welcome', compact('admin'));
        } else {
            return redirect()->back()->with('error', __('auth.not_match'));
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.showLogin');
    }
}
