@extends('dashboard.admin.layout.layout.app')
@section('title')
  Admin - Manage Admins
@endsection
@section('content')
<div class="dashboard-container" >
    <h1>Admins</h1>
    <div class="summary">
        <a href="{{route('admin.add.admin.show')}}" class="action-link edit">Add Admin</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>email</th>
                <th>Action</th>
          
            </tr>
        </thead>
        <tbody>
            @forelse ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                   
                
                    <td>
                        <a href="javascript:void(0)" onclick="document.getElementById('deleteAdmin').submit()" class="action-link delete">Block</a>
                        <form id="deleteAdmin" method="post" action="{{route('admin.delete.admin', $admin->id)}}">@csrf @method('DELETE')</form>
                    </td>
                </tr>
            @empty
                <div class="no-data">No admins found.</div>
            @endforelse

        </tbody>
    </table>
</div>
@endsection