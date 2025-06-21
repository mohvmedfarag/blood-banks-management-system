<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DonorAuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:50'
        ]);

        $donor = Donor::whereEmail($request->email)->first();

        if ($donor && Hash::check($request->password, $donor->password)) {
            $token = $donor->createToken('donor_token')->plainTextToken;
            return response()->json([
                'message' => 'donor logged successfully',
                'token' => $token
            ],200);
        }

        return response()->json([
            'message' => 'credentials dose not match',
        ],401);
    }
}
