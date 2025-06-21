@extends('dashboard.patient.layout.app')
@section('title')
  Patient - Requests
@endsection
@section('content')
    <div class="dashboard-container">
        <h1>Blood Requests History</h1>
        @if ($requests)
        <div class="summary">
            Total Donations: <strong>{{ Auth::user()->requests()->count() }}</strong>
            @if (Auth::user()->requests()->count()>0)
            | Last Donation: <strong>{{ \Carbon\Carbon::parse(Auth::user()->requests()
            ->latest()->first()->created_at)->format('y-m-d') ?? 'No donations yet' }}</strong>
            @endif
        </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Blood Type</th>
                    <th>Request Type</th>
                    <th>Quantity</th>
                    <th>Blood Bank</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($requests as $req)
                    <tr>
                        <td>{{ $req->id }}</td>
                        <td>{{ $req->blood_type }}</td>
                        <td>{{ $req->request_type }}</td>
                        <td>{{ $req->quantity }} Unit</td>
                        <td>{{ $req->bloodbank->name }}</td>
                        <td>{{ $req->status }}</td>
                        <td>
                            <a href="{{route('patient.requests.show.edit', $req->id)}}"
                                 class="action-link edit"><i class="fa-solid fa-pencil"></i></a>
                            <a href="javascript:void(0)" 
                            onclick="document.getElementById('deleteRequest{{$req->id}}').submit()"
                             class="action-link delete"><i class="fa-regular fa-trash-can"></i></a>
                            <form id="deleteRequest{{$req->id}}" method="post"
                                 action="{{route('patient.delete', $req->id)}}">@csrf</form>
                        </td>
                    </tr>
                @empty
                    <div class="no-data">No Blood Requests found.</div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
