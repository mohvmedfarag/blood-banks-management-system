<?php

namespace App\Http\Controllers\Auth\Donor;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendOtpNotify;
use App\Http\Requests\ForgetPasswordRequest;
use Ichtrojan\Otp\Otp;

class ForgetPasswordController extends Controller
{
    protected $otp2;

    public function __construct(){
        $this->otp2 = new Otp;
    }
    public function showEmailForm(){
        return view('auth.donor.password.email');
    }

    public function sendOtp(Request $request){
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $donor = Donor::where('email', $request->email)->first();
        // return $donor;
        if (!$donor) {
            return redirect()->back()->withErrors(['email'=>__('passwords.email_is_not_registered')]);
        }
        $donor->notify(new SendOtpNotify());
        return view('auth.donor.password.confirm', ['email' => $donor->email]);
    }

    public function showOtpForm($email){
        return view('auth.donor.password.confirm', ['email' => $email]);
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

        return redirect()->route('donor.password.reset', ['email' => $request->email]);
       
    }
}
