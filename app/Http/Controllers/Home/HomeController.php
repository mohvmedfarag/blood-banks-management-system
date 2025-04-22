<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function contact(Request $request){
        $data = $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'nullable|email',
            'phone' => 'numeric',
            'message' => 'required|min:5'
        ]);

        if(!$data){
            return redirect()->back()->with('error', 'something went wrong!');
        }

        Contact::create($data);

        return redirect()->back()->with('success', 'message sent successfully');
        
    }
}
