@extends('layouts.website.app')
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f9;
  margin: 0;
  
}

.blood-banks-container {
  max-width: 1400px; /* زيادة العرض الأقصى */
  margin: 0 auto;
  background: #fff;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.blood-banks-container h1 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.search-form {
  text-align: center;
  margin-bottom: 20px;
}

.search-form input[type="text"] {
  padding: 10px;
  width: 60%;
  border: 1px solid #ddd;
  border-radius: 4px 0 0 4px;
  font-size: 16px;
  outline: none;
}

.search-form button {
  padding: 5px 20px;
  background-color: #8d1e1e;
  color: #fff;
  border: none;
  border-radius: 0 4px 4px 0;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.search-form button:hover {
  background-color: #e81d1d;
}

/* Table styling */
.banks-table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
  font-size: 16px;  /* تكبير حجم النص داخل الجدول */
}

.banks-table thead {
  background-color: #8d1e1e;
  color: #fff;
}

.banks-table th,
.banks-table td {
  text-align: left;
  padding: 16px; /* زيادة مساحة الخلايا */
  border: 1px solid #ddd;
}

.banks-table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.banks-table tbody tr:hover {
  background-color: #f1f1f1;
}

.no-data {
  text-align: center;
  padding: 20px;
  color: #777;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .search-form input[type="text"] {
    width: 80%;
  }

  .banks-table th, .banks-table td {
    padding: 12px;
    font-size: 14px;
  }
}

  </style>
@section('content')
<div class="blood-banks-container">
    <h1>Blood Banks</h1>
    <form action="{{ route('welcome.bloodBanks.search') }}" method="GET" class="search-form">
      <input type="text" name="key" value="{{ old('key') }}" placeholder="Search for blood bank or your blood sample...">
      <button type="submit">Search</button>
    </form>
    <table class="banks-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Available Blood Samples</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($banks as $bank)
          <tr>
            <td>{{ $bank->name }}</td>
            <td>{{ $bank->governorate }} - {{ $bank->city }} - {{ $bank->street }} 
              <a href="{{ $bank->location }}"><i class="fa-solid fa-location-dot fa-lg" 
                style="color: #8d1e1e; cursor: pointer;"></i></a></td>
            <td>{{ $bank->phone }}</td>
            <td>{{ $bank->email }}</td>
            <td>{{ $bank->blood_samples->pluck('blood-sample')->implode(' | ') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="no-data">There are no blood banks</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  

@endsection