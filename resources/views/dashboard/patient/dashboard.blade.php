@extends('dashboard.patient.layout.app')
@section('title')
  Patient - Profile
@endsection
@section('content')
<div class="dashboard-container">
    <!-- Profile Header -->
    <div class="profile-header">
      <img src="{{asset("storage/$patient->image")}}" alt="">
      <div>
        <h1>{{ $patient->name }}</h1>
      <p>Patient</p>
      </div>
    </div>

    <div>
    <!-- Profile Details -->
    <div class="profile-details">
      <label>Email: <span>{{ $patient->email }}</span></label>
      

      <label>Phone: <span>{{ $patient->phone }}</span></label>
      

      <label>Address: <span>{{ $patient->address }}</span></label>
      

      <label>Age: <span>{{ $patient->age }} years</span></label>
      

      <label>Gender: <span>{{ $patient->gender }}</span></label>
      
    </div>

    <!-- Statistics Section -->
    @if ($totalRequests > 0)

    <div class="statistics">
      <h2>Donation Statistics</h2>
      <ul>
        <li>Total Requests: {{$totalRequests}}</li>
        <li>Last Request: {{ \Carbon\Carbon::parse($lastRequest->created_at)->format('y-m-d')}}</li>
        <li>Accepted Requests: {{$acceptedRequests}}</li>
        <li>Pending Requests: {{$pendingRequests}}</li>
        <li>Rejected Requests: {{$rejectedRequests}}</li>
      </ul>
    </div>
      
    @endif
</div>
    <!-- Edit Profile Button -->
    <div style="text-align: center;">
      <a href="{{route('patient.setting')}}" class="edit-btn">Edit Profile</a>
    </div>
  </div>
@endsection