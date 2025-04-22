<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Bloodbank;
use Illuminate\Http\Request;

class BloodBanksController extends Controller
{
    public function index()
    {
        $banks = Bloodbank::all();
        return view('bloodBanks', compact('banks'));
    }
    public function search(Request $request)
    {
        $key = $request->key;
        $banks = Bloodbank::where(function ($query) use ($key) {
            $query->where('name', 'like', "%{$key}%")
                ->orWhere('governorate', 'like', "%{$key}%")
                ->orWhere('city', 'like', "%{$key}%")
                ->orWhere('street', 'like', "%{$key}%");
        })
            ->orWhereHas('blood_samples', function ($q) use ($key) {
                $q->where('blood-sample', 'like', "%{$key}%");
            })
            ->get();
        return view('bloodBanks', compact('banks'));
    }

    // public function getCoordinatesFromAddress($address)
    // {
    //     $apiKey = config('services.google_maps.key'); // استدعاء مفتاح API من ملف الإعدادات
    //     $encodedAddress = urlencode($address);
    //     $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encodedAddress}&key={$apiKey}";
    
    //     $responseJson = file_get_contents($url);
    //     $response = json_decode($responseJson, true);
    
    //     if ($response['status'] === 'OK') {
    //         $location = $response['results'][0]['geometry']['location'];
    //         return [
    //             'latitude'  => $location['lat'],
    //             'longitude' => $location['lng']
    //         ];
    //     }
    //     return null; // إذا لم يتم العثور على الإحداثيات
    // }
    

}
