@extends('dashboard.donor.layout.app')
@section('title')
  Donor - Profile
@endsection
@section('content')
<div class="dashboard-container">
    <!-- Profile Header -->
    <div class="profile-header">
      <img src="{{asset("storage/$donor->image")}}" alt="">
      <h1>{{ $donor->name }}</h1>
      <p>Donor</p>
    </div>

    <div>
    <!-- Profile Details -->
    <div class="profile-details">
      <label>Email: <span>{{ $donor->email }}</span></label>
      

      <label>Phone: <span>{{ $donor->phone }}</span></label>
      

      <label>Address: <span>{{ $donor->address }}</span></label>
      

      <label>Age: <span>{{ $donor->age }} years</span></label>
      

      <label>Weight: <span>{{ $donor->weight }} kg</span></label>
      

      <label>Gender: <span>{{ $donor->gender }}</span></label>
      
    </div>

    <!-- Statistics Section -->
    <div class="statistics">
      @if($totalDonations > 0)
    <h2>Donation Statistics</h2>
    <ul>
        <li>Total Donations: {{$totalDonations}}</li>
        <li>Last Donation: {{$lastDonation->created_at}}</li>
        <li>Accepted Donations: {{$acceptedDonations}}</li>
        <li>Pending Donations: {{$pendingDonations}}</li>
        <li>Rejected Donations: {{$rejectedDonations}}</li>
    </ul>
@endif

    </div>
</div>
    <!-- Edit Profile Button -->
    <div style="text-align: center;">
      <a href="{{route('donor.setting')}}" class="edit-btn">Edit Profile</a>
    </div>
  </div>
@endsection