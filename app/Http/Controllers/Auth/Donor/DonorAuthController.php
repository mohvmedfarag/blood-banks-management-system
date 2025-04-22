<?php

namespace App\Http\Controllers\Auth\Donor;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Requests\DonorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\Middleware;

class DonorAuthController extends Controller
{
    protected function guard()
    {
        return Auth::guard('donor');
    }

    public function showRegisterForm()
    {
        if (! session()->has('visited_register_type')) {
            return redirect()->route('chooseRegistration')->with('error', 'Please select the registration type first');
        }
        return view('auth.donor.register');
    }

    public function register(DonorRequest $request)
    {
        $donor = Donor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'age' => $request->age,
            'weight' => $request->weight,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
        ]);

        if (!$donor) {
            return redirect()->back()->with('error', __('flash.error_msg'));
        }

        return redirect()->route('donor.showLoginForm')->with('success', __('flash.success_msg'));
    }

    public function showLoginForm()
    {
        if (! session()->has('visited_login_type')) {
            return redirect()->route('chooseLogin')->with('error', 'Please select the logging type first');
        }
        return view('auth.donor.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'exists:donors,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $donor = Donor::where('email', $request->email)->first();

        if ($donor && Hash::check($request->password, $donor->password)) {
            Auth::guard('donor')->login($donor);
            session()->flash('success', 'logged successfully');
            return redirect()->route('donor.dashboard');
            // return view('welcome', compact('donor'));
        } else {
            return redirect()->back()->with('error', __('auth.not_match'));
        }
    }

    public function logout()
    {
        Auth::guard('donor')->logout();
        session()->flash('success', 'logged out successfully');
        return redirect()->route('chooseLogin');
    }
}
