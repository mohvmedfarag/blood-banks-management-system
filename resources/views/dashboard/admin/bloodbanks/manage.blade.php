@extends('dashboard.admin.layout.layout.app')
@section('title')
  Admin - Manage BloodBanks
@endsection
@section('content')
<div class="dashboard-container" >
    <h1>Blood Banks</h1>
    <div class="summary">
        Total Blood Banks: <strong>{{$bloodbanks->count()}}</strong> | <a href="{{route('admin.dashboard.bloodbanks.create')}}" class="action-link edit">Add Blood Bank</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Blood Bank</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($bloodbanks as $bank)
                <tr>
                    <td>{{ $bank->id }}</td>
                    <td>{{ $bank->name }}</td>
                    <td>{{ $bank->governorate . ' , ' . $bank->city }}</td>
                    <td>{{ $bank->phone }}</td>
                    <td>{{ $bank->email }}</td>
                    <td><a href="{{route('admin.dashboard.bloodbanks.showFormEditBank', $bank->id)}}" class="action-link edit"><i class="fa-solid fa-pencil"></i></a></td>
                    <td>
                        <a href="javascript:void(0)" onclick="document.getElementById('deleteBank{{ $bank->id }}').submit()"
                           class="action-link delete"><i class="fa-regular fa-trash-can"></i></a>
                        <form id="deleteBank{{ $bank->id }}" method="post" action="{{ route('admin.dashboard.bloodbanks.delete', $bank->id) }}">
                            @csrf
                        </form>
                    </td>
                </tr>
            @empty
                <div class="no-data">No Blood Banks found.</div>
            @endforelse

        </tbody>
    </table>
</div>
@endsection