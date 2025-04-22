@extends('dashboard.admin.layout.layout.app')
@section('title')
    Admin - Show Request
@endsection

<style>
    /* public/css/request-details.css */

.dashboard-container h2 {
  text-align: center;
  margin-bottom: 30px;
  color: #333;
}

.card {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  padding: 20px;
  margin-bottom: 25px;
}

.card h3 {
  margin-bottom: 15px;
  font-size: 1.2rem;
  color: #8d1e1e;
}

.detail-row {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid #eee;
}

.detail-row:last-child {
  border-bottom: none;
}

.label {
  font-weight: bold;
  color: #555;
}

.value {
  color: #333;
}

.value.status-approved {
  color: #27ae60;
  font-weight: bold;
}

.value.status-rejected {
  color: #e74c3c;
  font-weight: bold;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #8d1e1e;
  color: #fff;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color .3s;
}

.btn:hover {
  background-color: #a22b2b;
}

</style>

@section('content')

<div class="dashboard-container">
  <h2>Donation Request Details</h2>

  <!-- Patient Information -->
  <div class="card">
    <h3>Patient Information</h3>
    <div class="detail-row">
      <span class="label">Name</span>
      <span class="value">{{ $request->patient->name }}</span>
    </div>
    <div class="detail-row">
      <span class="label">Age</span>
      <span class="value">{{ $request->patient->age }} years</span>
    </div>
    <div class="detail-row">
      <span class="label">Email</span>
      <span class="value">{{ $request->patient->email }}</span>
    </div>
    <div class="detail-row">
      <span class="label">Phone</span>
      <span class="value">{{ $request->patient->phone }}</span>
    </div>
    <div class="detail-row">
      <span class="label">Address</span>
      <span class="value">{{ $request->patient->address }}</span>
    </div>
  </div>

  <!-- Request Information -->
  <div class="card">
    <h3>Request Information</h3>
    <div class="detail-row">
      <span class="label">Blood Type</span>
      <span class="value">{{ $request->blood_type }}</span>
    </div>
    <div class="detail-row">
      <span class="label">Request Type</span>
      <span class="value">{{ ucwords(str_replace('_',' ',$request->request_type)) }}</span>
    </div>
    <div class="detail-row">
      <span class="label">Quantity</span>
      <span class="value">{{ $request->quantity }} Unit(s)</span>
    </div>
    <div class="detail-row">
      <span class="label">Blood Bank</span>
      <span class="value">{{ $request->bloodbank->name }}</span>
    </div>
    <div class="detail-row">
      <span class="label">Status</span>
      <span class="value status-{{ $request->status }}">
        {{ ucfirst($request->status) }}
      </span>
    </div>
  </div>

  <a href="{{ url()->previous() }}" class="btn">Back to Requests</a>
</div>
@endsection