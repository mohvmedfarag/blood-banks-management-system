<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\Bloodbank;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DonorController extends Controller
{
    public function index()
    {
        $donor = Auth::guard('donor')->user();
        $lastDonation = $donor->donations()->latest()->first();
        $pendingDonations = $donor->donations()->where('status', 'Pending')->count();
        $acceptedDonations = $donor->donations()->where('status', 'Accepted')->count();
        $rejectedDonations = $donor->donations()->where('status', 'Rejected')->count();
        $totalDonations = $donor->donations()->count();

        return view(
            'dashboard.donor.dashboard',
            compact('donor', 'lastDonation', 'pendingDonations', 'acceptedDonations', 'rejectedDonations', 'totalDonations')
        );
    }
    public function showFormRequest()
    {
        $bloodbanks = Bloodbank::all();
        return view('dashboard.donor.newDonate', compact('bloodbanks'));
    }

    public function donateBlood(Request $request)
    {

        $data = $request->validate([
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'quantity' => 'required|integer|min:1',
            'donation_type' => 'nullable|in:Whole Blood,Plasma,Platelets',
            'donation_date' => 'required|string',
            'bloodbank_id' => 'required|exists:bloodbanks,id',
        ]);

        if (!$data) {
            return redirect()->back()->with('error', 'something wrong happened try again');
        }
        $donor = Auth::user();
        Donation::create([
            'blood_type' => $data['blood_type'],
            'quantity' => $data['quantity'],
            'donation_type' => $data['donation_type'],
            'donation_date' => $data['donation_date'],
            'bloodbank_id' => $data['bloodbank_id'],
            'donor_id' => $donor->id,
        ]);

        return redirect()->back()->with('success', 'request send successfully');
    }

    public function donations()
    {
        $donor = Auth::user();
        $donations = Donation::where('donor_id', $donor->id)->get();
        return view('dashboard.donor.donations', compact('donations'));
    }

    public function showEdit($id)
    {
        $donate = Donation::where('id', $id)->first();
        $bloodbanks = Bloodbank::all();
        if (!$donate) {
            return redirect()->back()->with('error', 'donation not found');
        }

        return view('dashboard.donor.edit', compact('donate', 'bloodbanks'));
    }

    public function edit(Request $request, $id)
    {
        $donation = Donation::find($id);
        $data = $request->validate([
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'quantity' => 'required|integer|min:1',
            'donation_type' => 'nullable|in:full_blood,plasma,platelets',
            'donation_date' => 'required|string',
            'bloodbank_id' => 'required|exists:bloodbanks,id',
        ]);

        $donation->update([
            'blood_type' => $data['blood_type'],
            'quantity' => $data['quantity'],
            'donation_type' => $data['donation_type'],
            'donation_date' => $data['donation_date'],
            'bloodbank_id' => $data['bloodbank_id'],
        ]);
        return redirect()->back()->with('success', 'donation updated successfully!');
    }

    public function delete(Request $request, $id){
        $id = Donation::where('id' , $id)->delete();
        return redirect()->back()->with('success', 'Donation deleted successfully');
    }

    public function showSetting()
    {
        $donor = Donor::findOrFail(auth()->user()->id);
        return view('dashboard.donor.settings', compact('donor'));
    }

    public function changeImageProfile(Request $request)
    {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        $donor = Donor::findOrFail(auth()->user()->id);

        if ($request->hasFile('image')) {
            $newImage = Storage::disk('public')->putFile('donors', $request->file('image'));

            if ($donor->image && $donor->image != 'images/default.png') {

                if (Storage::disk('public')->exists($donor->image)) {
                    Storage::disk('public')->delete($donor->image);
                }
            }
            $donor->update(['image' => $newImage]);
            return redirect()->back()->with('success', 'Profile Image Updated Successfully');
        }
    }

    public function editProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('donors', 'email')->ignore(auth()->user()->id)],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:100'],
            'age' => ['required', 'numeric', 'min:18', 'max:60'],
            'weight' => ['required', 'numeric', 'min:50'],
            'gender' => ['required', 'in:male,female'],
        ]);
        $donor = Donor::findOrFail(auth()->user()->id);
        
        $donor->update($data);
        return redirect()->back()->with('success', 'Data updated successfully');
    }

    public function changePassword(Request $request){
        $request->validate([
            'currentPassword' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $donor = Donor::findOrFail(auth()->user()->id);

        if (!Hash::check($request->currentPassword, $donor->password)) {
            return redirect()->back()->with('error', 'password does not match');
        }

        $donor->update([
            'password' => bcrypt($request->password),
        ]);
        return redirect()->back()->with('success', 'Password Changed successfully');
    }

    public function showNotifications(){
        $donor = auth('donor')->user();
    
        $notifications = $donor->notifications;
    
        foreach ($donor->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
    
        return view('dashboard.donor.notifications', compact('notifications'));
    }

    public function deleteNotification($id){
        $donor = Auth::guard('donor')->user();
        $notify = $donor->notifications()->findOrFail($id);
        $notify->delete();
        return redirect()->back()->with('info', 'notification deleted successfully');
    }
}
