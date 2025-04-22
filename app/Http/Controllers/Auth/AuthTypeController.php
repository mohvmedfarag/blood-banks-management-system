<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthTypeController extends Controller
{
    public function registerType(){
        session(['visited_register_type' => true]);
        return view('auth.registerType');
    }
    public function loginType(){
        session(['visited_login_type' => true]);
        return view('auth.loginType');
    }
}
