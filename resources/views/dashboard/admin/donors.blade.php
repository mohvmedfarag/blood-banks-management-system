@extends('dashboard.admin.layout.layout.app')
@section('title')
  Admin - Manage Donors
@endsection
@section('content')
<div class="dashboard-container" >
    <h1>Donation History</h1>
    <div class="summary">
        Total Donations: <strong>25</strong> | Last Donation: <strong>2024-10-15</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Donor</th>
                <th>email</th>
                <th>phone</th>
                <th>age</th>
                <th>weight</th>
                <th>Blood Type</th>
                
                <th>Action</th>
          
            </tr>
        </thead>
        <tbody>
            @forelse ($donors as $donor)
                <tr>
                    <td>{{ $donor->id }}</td>
                    <td>{{ $donor->name }}</td>
                    <td>{{ $donor->email }}</td>
                    <td>{{ $donor->phone }}</td>
                    <td>{{ $donor->age }}</td>
                    <td>{{ $donor->weight }} kg</td>
                    <td>none</td>
                    <td>
                        <a href="javascript:void(0)" onclick="document.getElementById('deleteDonate').submit()" class="action-link delete">Block</a>
                        <form id="deleteDonate" method="post" action="{{route('admin.dashboard.donors.block', $donor->id)}}">@csrf</form>
                    </td>
                </tr>
            @empty
                <div class="no-data">No donations found.</div>
            @endforelse

        </tbody>
    </table>
</div>
@endsection