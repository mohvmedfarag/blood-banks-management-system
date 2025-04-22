<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AdminMessageNotification;

class SendNotifyController extends Controller
{
    public function index(){
        $patients = Patient::all();
        return view('dashboard.admin.notifications.send', compact('patients'));
    }

    public function sendNotification(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'message'    => 'required|string',
        ]);

        $patient = Patient::find($data['patient_id']);
        $patient->notify(new AdminMessageNotification($data['message']));

        return redirect()
            ->back()
            ->with('success', 'Notification sent to ' . $patient->name);
    }
}
