<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donor;
use App\Models\Patient;
use App\Models\Donation;
use App\Models\Bloodbank;
use App\Models\BloodSample;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Request as ModelsRequest;
use App\Notifications\BloodRequestStatusNotification;
use App\Notifications\DonateBloodStatusNotification;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.dashboard');
    }

    public function bloodbanks()
    {
        $bloodbanks = Bloodbank::all();
        return view('dashboard.admin.bloodbanks.manage', compact('bloodbanks'));
    }

    public function showCreateBankForm()
    {
        return view('dashboard.admin.bloodbanks.create');
    }

    public function storeBank(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'governorate' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'location' => 'nullable|string',
            'email' => 'required|email|max:255|unique:bloodbanks,email',
            'phone' => 'required|string|max:20|unique:bloodbanks,phone',
            'blood_samples' => 'nullable|array',
            'blood_samples.*' => 'in:A+,B+,AB+,O+,A-,B-,AB-,O-',
        ]);

        $bloodBank = Bloodbank::create([
            'name' => $data['name'],
            'governorate' => $data['governorate'],
            'city' => $data['city'],
            'street' => $data['street'],
            'location' => $data['location'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        if (! empty($data['blood_samples'])) {
            foreach ($data['blood_samples'] as $sample) {
                BloodSample::create([
                    'bloodbank_id' => $bloodBank->id,
                    'blood-sample' => $sample,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Blood bank added successfully with selected blood samples.');
    }

    public function showFormEditBank($id)
    {
        $bloodbank = Bloodbank::findOrFail($id);
        return view('dashboard.admin.bloodbanks.edit', compact('bloodbank'));
    }

    public function updateBank(Request $request, $id)
    {
        $bloodbank = Bloodbank::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'governorate' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'location' => 'nullable|string',
            'email' => 'required|email|max:255|unique:bloodbanks,email,'.$bloodbank->id,
            'phone' => 'required|string|max:20|unique:bloodbanks,phone,'.$bloodbank->id,
            'blood_samples' => 'nullable|array',
            'blood_samples.*' => 'in:A+,B+,AB+,O+,A-,B-,AB-,O-',
        ]);

        $bloodbank->update([
            'name' => $data['name'],
            'governorate' => $data['governorate'],
            'city' => $data['city'],
            'street' => $data['street'],
            'location' => $data['location'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        $bloodbank->blood_samples()->delete();

        if (!empty($data['blood_samples'])) {
            foreach ($data['blood_samples'] as $sample) {
                $bloodbank->blood_samples()->create([
                    'blood-sample' => $sample,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Blood Bank updated successfully.');
    }

    public function deleteBank($id)
    {
        $bloodBank = BloodBank::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Blood Bank deleted successfully');
    }

    public function donations()
    {
        $donations = Donation::all();
        return view('dashboard.admin.donations', compact('donations'));
    }

    public function acceptDonation($id){
        $donation = Donation::where('id', $id)->first();
        if ($donation) {
            $donation->update([
                'status' => 'Accepted',
            ]);
            $status = $donation->status;
            $donor = $donation->donor;
            $donor->notify( new DonateBloodStatusNotification($donation, $status) );
            return redirect()->back()->with('success', 'Donation accepted');
        }
    }

    public function rejectDonation($id){
        $donation = Donation::where('id', $id)->first();
        if ($donation) {
            $donation->update([
                'status' => 'Rejected',
            ]);
            $status = $donation->status;
            $donor = $donation->donor;
            $donor->notify( new DonateBloodStatusNotification($donation, $status) );
            return redirect()->back()->with('success', 'Donation Rejected');
        }
    }

    public function bloodRequests(){
        $requests = ModelsRequest::all();
        return view('dashboard.admin.bloodRequests', compact('requests'));
    }

    public function acceptRequest($id){
        $bloodRequest = ModelsRequest::where('id', $id)->first();
        if ($bloodRequest) {
            $bloodRequest->update([
                'status' => 'approved',
            ]);
            $status = $bloodRequest->status;
            $patient = $bloodRequest->patient;

            $patient->notify( new BloodRequestStatusNotification($bloodRequest, $status) );
            return redirect()->back()->with('success', 'Request accepted');
        }
    }

    public function rejectRequest($id){
        $bloodRequest = ModelsRequest::where('id', $id)->first();
        if ($bloodRequest) {
            $bloodRequest->update([
                'status' => 'rejected',
            ]);
            $status = $bloodRequest->status;
            $patient = $bloodRequest->patient;

            $patient->notify( new BloodRequestStatusNotification($bloodRequest, $status) );
            return redirect()->back()->with('success', 'Request accepted');
        }
    }

    public function showRequest($id){
        $request = ModelsRequest::with('patient','bloodbank')->findOrFail($id);
        return view('dashboard.admin.showRequest', compact('request'));
    }

    public function donors(){
        $donors = Donor::all();
        return view('dashboard.admin.donors', compact('donors'));
    }

    public function blockDonor($id){
        Donor::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Donor Blocked Successfully!');
    }

    public function patients(){
        $patients = Patient::all();
        return view('dashboard.admin.patients', compact('patients'));
    }

    public function blockPatient($id){
        Patient::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Patient Blocked Successfully!');
    }

    public function showAdmins(){
        $admins = Admin::where('id', '!=', 1)->get();
        return view('dashboard.admin.manage-admins.admins', compact('admins'));
    }
    
    public function addAdminForm(){
        return view('dashboard.admin.manage-admins.addAdmin');
    }

    public function addAdmin(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return redirect()->back()->with('success', 'admin added successfully');
    }

    public function deleteAdmin($id){
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('info', 'Admin Deleted Successfully');
    }
}
