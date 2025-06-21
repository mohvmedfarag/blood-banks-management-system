@extends('dashboard.admin.layout.layout.app')
@section('title')
  Admin - Blood Requests
@endsection
@section('content')
<div class="dashboard-container" >
    <h1>Donation History</h1>
    <div class="summary">
        Total Donations: <strong>{{$requests->count()}}</strong> | Last Donation: <strong>2024-10-15</strong>
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
                <th></th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requests as $req)
                <tr>
                    <td>{{ $req->id }}</td>
                    <td>{{ $req->patient->name }}</td>
                    <td>{{ $req->patient->age }}</td>
                    <td>{{ $req->blood_type }}</td>
                    <td>{{ $req->request_type }}</td>
                    <td>{{ $req->quantity }} Unit</td>
                    <td>{{ rtrim($req->bloodbank->name, "blood bank") }}</td>
                    <td>{{ $req->status }}</td>
                    <td>
                        <a href="javascript:void(0)" onclick="document.getElementById('acceptDonation{{$req->id}}').submit()" class="action-link edit">Accept</a>
                        <form id="acceptDonation{{$req->id}}" method="POST" action="{{route('admin.dashboard.requests.accept', $req->id)}}">
                            @csrf
                        </form>
                    </td>

                    <td>
                        <a href="javascript:void(0)" onclick="document.getElementById('deleteDonate{{$req->id}}').submit()" class="action-link delete">Reject</a>
                        <form id="deleteDonate{{$req->id}}" method="post" action="{{route('admin.dashboard.requests.reject', $req->id)}}">@csrf</form>
                    </td>
                    <td>
                        <a href="{{route('admin.dashboard.showRequest', $req->id)}}" class="action-link delete">show</a>
                    </td>
                </tr>
            @empty
                <div class="no-data">No donations found.</div>
            @endforelse

        </tbody>
    </table>
</div>
@endsection