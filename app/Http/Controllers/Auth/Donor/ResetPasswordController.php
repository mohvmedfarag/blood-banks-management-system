<?php

namespace App\Http\Controllers\Auth\Donor;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm($email){
        return view('auth.donor.password.reset', ['email' => $email]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed'
        ]);

        $donor = Donor::where('email', $request->email)->first();

        if (!$donor) {
            return redirect()->back()->with('error', 'try again later');
        }

        $donor->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('donor.showLoginForm')->with('success', 'password changed successfully');
    }
}
