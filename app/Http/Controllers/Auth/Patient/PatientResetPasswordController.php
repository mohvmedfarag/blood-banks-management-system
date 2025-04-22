<?php

namespace App\Http\Controllers\Auth\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientResetPasswordController extends Controller
{
    public function showResetForm($email){
        return view('auth.patient.password.reset', ['email' => $email]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed'
        ]);

        $patient = Patient::where('email', $request->email)->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'try again later');
        }

        $patient->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('patient.showLoginForm')->with('success', 'password changed successfully');
    }
}
