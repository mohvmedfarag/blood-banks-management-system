@extends('dashboard.admin.layout.layout.app')
@section('title')
    Admin - Contacts
@endsection
@section('content')
    <div class="dashboard-container">
        <h1>Contacts</h1>
        <div class="summary">

        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>

                @forelse ($contacts as $con)
                    <tr>
                        <td>{{ $con->id }}</td>
                        <td>{{ $con->first_name . ' ' . $con->last_name }}</td>
                        <td>{{ $con->email }}</td>
                        <td>{{ $con->phone }}</td>
                        <td>{{ $con->message }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="document.getElementById('deleteContact{{ $con->id }}').submit()"
                                class="action-link delete">Delete</a>
                            <form id="deleteContact{{ $con->id }}" method="post"
                                action="{{ route('admin.deleteContact', $con->id) }}">@csrf</form>
                        </td>



                    </tr>
                @empty
                    <div class="no-data">No Contacts found.</div>
                @endforelse

            </tbody>
        </table>
    </div>
@endsection
