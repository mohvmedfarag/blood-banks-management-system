<?php

namespace App\Http\Controllers\Api;

use App\Models\Bloodbank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function bloodbanks()
    {
        $bloodbanks = Bloodbank::get();
        return response()->json($bloodbanks);
    }
}
