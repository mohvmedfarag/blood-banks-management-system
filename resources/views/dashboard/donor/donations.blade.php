@extends('dashboard.donor.layout.app')
@section('title')
  Donor - Donations
@endsection
@section('content')
    <div class="dashboard-container">
        <h1>Donation History</h1>
        <div class="summary">
            Total Donations: <strong>25</strong> | Last Donation: <strong>2024-10-15</strong>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Blood Type</th>
                    <th>Donation Type</th>
                    <th>Quantity</th>
                    <th>Blood Bank</th>
                    <th>status</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donations as $donate)
                    <tr>
                        <td>{{ $donate->id }}</td>
                        <td>{{ $donate->blood_type }}</td>
                        <td>{{ $donate->donation_type }}</td>
                        <td>{{ $donate->quantity }} Unit</td>
                        <td>{{ $donate->bloodbank->name }}</td>
                        <td>{{ $donate->status }}</td>
                        <td>
                            <a href="{{route('donor.donation.show.edit', $donate->id)}}" class="action-link edit"><i class="fa-solid fa-pencil"></i></a>
                            <a href="javascript:void(0)" onclick="document.getElementById('deleteDonate').submit()" class="action-link delete"><i class="fa-regular fa-trash-can"></i></a>
                            <form id="deleteDonate" method="post" action="{{route('donor.delete', $donate->id)}}">@csrf</form>
                        </td>
                    </tr>
                @empty
                    <div class="no-data">No donations found.</div>
                @endforelse

            </tbody>
        </table>
    </div>
@endsection
