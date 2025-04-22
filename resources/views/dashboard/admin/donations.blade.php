@extends('dashboard.admin.layout.layout.app')
@section('title')
  Admin - Donations
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
                <th>Age</th>
                <th>Blood Type</th>
                <th>Donation Type</th>
                <th>Quantity</th>
                <th>Blood Bank</th>
                <th>Status</th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($donations as $donate)
                <tr>
                    <td>{{ $donate->id }}</td>
                    <td>{{ $donate->donor->name }}</td>
                    <td>{{ $donate->donor->age }}</td>
                    <td>{{ $donate->blood_type }}</td>
                    <td>{{ $donate->donation_type }}</td>
                    <td>{{ $donate->quantity }} Unit</td>
                    <td>{{ rtrim($donate->bloodbank->name, "blood bank") }}</td>
                    <td>{{ $donate->status }}</td>
                    <td>
                        <a href="javascript:void(0)" onclick="document.getElementById('acceptDonation').submit()" class="action-link edit">Accept</a>
                        <form id="acceptDonation" method="POST" action="{{route('admin.dashboard.donations.accept', $donate->id)}}">
                            @csrf
                        </form>
                    </td>

                    <td>
                        <a href="javascript:void(0)" onclick="document.getElementById('deleteDonate').submit()" class="action-link delete">Reject</a>
                        <form id="deleteDonate" method="post" action="{{route('admin.dashboard.donations.reject', $donate->id)}}">@csrf</form>
                    </td>
                </tr>
            @empty
                <div class="no-data">No donations found.</div>
            @endforelse

        </tbody>
    </table>
</div>
@endsection