<?php

namespace App\Http\Controllers\Auth\Patient;

use Ichtrojan\Otp\Otp;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendOtpNotify;

class PatientForgetPasswordController extends Controller
{
    protected $otp2;

    public function __construct(){
        $this->otp2 = new Otp;
    }
    public function showEmailForm(){
        return view('auth.patient.password.email');
    }

    public function sendOtp(Request $request){
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $patient = Patient::where('email', $request->email)->first();
        // return $patient;
        if (!$patient) {
            return redirect()->back()->withErrors(['email'=>__('passwords.email_is_not_registered')]);
        }
        $patient->notify(new SendOtpNotify());
        return view('auth.patient.password.confirm', ['email' => $patient->email]);
    }

    public function showOtpForm($email){
        return view('auth.patient.password.confirm', ['email' => $email]);
    }

    public function verifyOtp(Request $request){
        $request->validate([
            'email' =>'required|email',
            'otp' =>'required|min:4'
        ]);

        $otp = $this->otp2->validate($request->email, $request->otp);
        if ($otp->status == false) {
            return redirect()->back()->with(['error' => 'code not correct']);
        }

        return redirect()->route('patient.password.reset', ['email' => $request->email]);
       
    }
}
