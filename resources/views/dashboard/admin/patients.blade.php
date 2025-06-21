@extends('dashboard.admin.layout.layout.app')
@section('title')
  Admin - Manage Patients
@endsection
@section('content')
<div class="dashboard-container" >
    <h1>Donation History</h1>
    <div class="summary">
        Total Donations: <strong>{{$patients->count()}}</strong> | Last Donation: <strong>2024-10-15</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Donor</th>
                <th>email</th>
                <th>phone</th>
                <th>age</th>
            
                <th>Blood Type</th>
                
                <th>Action</th>
          
            </tr>
        </thead>
        <tbody>
            @forelse ($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->age }}</td>
                    
                    <td>none</td>
                    <td>
                        <a href="javascript:void(0)" onclick="document.getElementById('deleteDonate').submit()" class="action-link delete">Delete</a>
                        <form id="deleteDonate" method="post" action="{{route('admin.dashboard.patients.block', $patient->id)}}">@csrf</form>
                    </td>
                </tr>
            @empty
                <div class="no-data">No donations found.</div>
            @endforelse

        </tbody>
    </table>
</div>
@endsection