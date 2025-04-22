@extends('dashboard.admin.layout.layout.app')
@section('title')
  Admin - Add Admin
@endsection
@section('content')
    <!-- Blood Banks Form -->
    <div class="dashboard-container" style="width:60pc">
        <div id="donate" class="tab" style="display: block;">
            <h2 style="text-align: center">Create Blood Bank</h2>
            <form method="post" action="" id="donateForm"
                class="donation-form">
                @csrf

                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
                @error('name')
                    {{$message}}
                @enderror

                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
                @error('email')
                    {{$message}}
                @enderror

                <label for="password">password:</label>
                <input type="password" id="password" name="password">
                @error('password')
                    {{$message}}
                @enderror
                <br/>

                <label for="password">confirm password:</label>
                <input type="password" id="password" name="password_confirmation">
                @error('password')
                    {{$message}}
                @enderror
                <br/>

                <div class="form-group">
                    <button type="submit" class="submit-btn">Add Admin</button>
                </div>
            </form>
        </div>
    </div>
@endsection
