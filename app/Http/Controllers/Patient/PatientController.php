<?php

namespace App\Http\Controllers\Patient;

use App\Models\Patient;
use App\Models\Bloodbank;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Request as ModelsRequest;

class PatientController extends Controller
{
    public function index(){
        $patient = Auth::guard('patient')->user();
        $lastRequest = $patient->requests()->latest()->first();
        $pendingRequests = $patient->requests()->where('status', 'pending')->count();
        $acceptedRequests = $patient->requests()->where('status', 'approved')->count();
        $rejectedRequests = $patient->requests()->where('status', 'rejected')->count();
        $totalRequests = $patient->requests()->count();
        return view('dashboard.patient.dashboard', 
        compact('patient', 'lastRequest', 'totalRequests', 'acceptedRequests', 'rejectedRequests', 'pendingRequests'));
    }

    public function showFormRequest(){
        $bloodbanks = Bloodbank::all();
        return view('dashboard.patient.newDonate', compact('bloodbanks'));
    }

    public function bloodRequest(Request $request)
    {
        
        $data = $request->validate([
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'quantity' => 'required|integer|min:1',
            'request_type' => 'nullable|in:Full_blood,Plasma,Platelets',
            'bloodbank_id' => 'required|exists:bloodbanks,id',
        ]);

        if (!$data) {
            return redirect()->back()->with('error', 'something wrong happened try again');
        }
        $patient = Auth::user();
        ModelsRequest::create([
            'blood_type' => $data['blood_type'],
            'quantity' => $data['quantity'],
            'request_type' => $data['request_type'],
            'bloodbank_id' => $data['bloodbank_id'],
            'patient_id' => $patient->id,
        ]);

        return redirect()->back()->with('success', 'request send successfully');
    }

    public function BloodRequests()
    {
        $patient = Auth::user();
        $requests = ModelsRequest::where('patient_id', $patient->id)->get();
        return view('dashboard.patient.requests', compact('requests'));
    }

    public function showEdit($id)
    {
        $req = ModelsRequest::where('id', $id)->first();
        $bloodbanks = Bloodbank::all();
        if (!$req) {
            return redirect()->back()->with('error', 'Request not found');
        }

        return view('dashboard.patient.edit', compact('req', 'bloodbanks'));
    }

    public function edit(Request $request, $id)
    {
        $req = ModelsRequest::find($id);
        $data = $request->validate([
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'quantity' => 'required|integer|min:1',
            'request_type' => 'nullable|in:Full_blood,Plasma,Platelets',
            'bloodbank_id' => 'required|exists:bloodbanks,id',
        ]);

        $req->update([
            'blood_type' => $data['blood_type'],
            'quantity' => $data['quantity'],
            'request_type' => $data['request_type'],
            'bloodbank_id' => $data['bloodbank_id'],
        ]);
        return redirect()->back()->with('success', 'Request updated successfully!');
    }

    public function delete(Request $request, $id){
        $id = ModelsRequest::where('id' , $id)->delete();
        return redirect()->back()->with('success', 'Request deleted successfully');
    }
    public function showSetting()
    {
        $patient = Patient::findOrFail(Auth::user()->id);
        return view('dashboard.patient.settings', compact('patient'));
    }

    public function changeImageProfile(Request $request)
    {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        $patient = Patient::findOrFail(Auth::user()->id);

        if ($request->hasFile('image')) {
            $newImage = Storage::disk('public')->putFile('patients', $request->file('image'));

            if ($patient->image && $patient->image != 'images/default.png') {

                if (Storage::disk('public')->exists($patient->image)) {
                    Storage::disk('public')->delete($patient->image);
                }
            }
            $patient->update(['image' => $newImage]);
            return redirect()->back()->with('success', 'Profile Image Updated Successfully');
        }
    }

    public function editProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('patients', 'email')->ignore(Auth::user()->id)],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:100'],
            'age' => ['required', 'numeric', 'min:18', 'max:60'],
            'gender' => ['required', 'in:male,female'],
        ]);
        $patient = Patient::findOrFail(Auth::user()->id);
        
        $patient->update($data);
        return redirect()->back()->with('success', 'Data updated successfully');
    }

    public function changePassword(Request $request){
        $request->validate([
            'currentPassword' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $patient = Patient::findOrFail(Auth::user()->id);

        if (!Hash::check($request->currentPassword, $patient->password)) {
            return redirect()->back()->with('error', 'password does not match');
        }

        $patient->update([
            'password' => bcrypt($request->password),
        ]);
        return redirect()->back()->with('success', 'Password Changed successfully');
    }

    public function showNotifications()
    {
        $patient = auth('patient')->user();
    
        $notifications = $patient->notifications;
    
        foreach ($patient->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
    
        return view('dashboard.patient.notifications', compact('notifications'));
    }

    public function deleteNotification($id){
        $patient = Auth::guard('patient')->user();
        $notify = $patient->notifications()->findOrFail($id);
        $notify->delete();
        return redirect()->back()->with('info', 'notification deleted successfully');
    }
    
}
