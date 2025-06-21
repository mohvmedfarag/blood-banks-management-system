<?php

namespace App\Http\Controllers\Auth\Patient;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientAuthController extends Controller
{
    public function showRegisterForm()
    {
        if (! session()->has('visited_register_type')) {
            return redirect()->route('chooseRegistration')->with('error', 'Please select the registration type first');
        }
        return view('auth.patient.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:donors,email'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:100'],
            'age' => ['required', 'numeric', 'min:18', 'max:60'],
            'gender' => ['required', 'in:male,female'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'age' => $request->age,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
        ]);

        if (!$patient) {
            return redirect()->back()->with('error', 'try again');
        }

        return redirect()->route('patient.showLoginForm')->with('success', 'account created');
    }

    public function showLoginForm(){
        if (! session()->has('visited_login_type')) {
            return redirect()->route('chooseLogin')->with('info', 'select the logging type to login');
        }
        return view('auth.patient.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'exists:patients,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $patient = Patient::where('email', $request->email)->first();

        if($patient && Hash::check($request->password, $patient->password)){
            Auth::guard('patient')->login($patient);
            session()->flash('success', 'logged successfully');
            return redirect()->route('patient.dashboard');
        }
        return redirect()->back()->with('error', __('auth.not_match'));
    }

    public function logout(){
        Auth::guard('patient')->logout();
        session()->flash('success', 'logged out successfully');
        return redirect()->route('chooseLogin');
    }
}
