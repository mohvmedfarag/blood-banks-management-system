<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function storeContact(Request $request){
        $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'required|email',
            'phone' => 'numeric',
            'message' => 'required|min:5'
        ]);

        $contact = Contact::create($request->all());

        if (!$contact) {
            return response()->json([ 'message' => 'try again later' ], 400);
        }

        return response()->json(['message' => 'contact created successfully'], 200);
    }
}
