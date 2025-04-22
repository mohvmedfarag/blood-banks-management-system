@extends('dashboard.donor.layout.app')
@section('title')
  Donor - Settings
@endsection
@section('content')
    <section class="content">
        <div id="settings" class="tab">
            <br />
            <h2>Settings</h2>
            <br />
            <form method="post" action="{{ route('donor.updateProfile.changeImageProfile') }}" enctype="multipart/form-data"
                id="settingsForm" class="settings-form">
                @csrf
                @method('PUT')
                <div class="form-group" style="display: flex; flex-direction:row; align-items:center; gap:20px">
                    <input type="file" name="image">

                    <img src="{{ asset("storage/$donor->image") }}" style="width: 150px" />

                </div>
                @error('image')
                    <strong style="color: #dc3545">{{ $message }}</strong>
                @enderror


                <div class="form-group">
                    <button type="submit" class="settings-save-btn">Change Image </button>
                </div>
            </form>

            <br />

            <form method="post" action="{{ route('donor.editProfile')}}" id="settingsForm" class="settings-form">
                @csrf
                <div class="form-group">
                    <label for="userName">Name:</label>
                    <input type="text" id="userName" name="name" value="{{ $donor->name }}">
                    @error('name')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">email:</label>
                    <input type="text" id="email" name="email" value="{{ $donor->email }}">
                    @error('email')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone:</label>
                    <input type="text" id="phoneNumber" name="phone" value="{{ $donor->phone }}">
                    @error('phone')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="{{ $donor->address }}">
                    @error('address')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" value="{{ $donor->age }}">
                    @error('age')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="weight">weight:</label>
                    <input type="number" id="weight" name="weight" value="{{ $donor->weight }}">
                    @error('weight')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="gender-group">
                    <label class="group-label">Gender:</label>
                    <label class="radio-inline" for="gender-male">
                        <input type="radio" id="gender-male" name="gender" value="male"> Male
                    </label>
                    <label class="radio-inline" for="gender-female">
                        <input type="radio" id="gender-female" name="gender" value="female"> Female
                    </label>
                    @error('gender')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="settings-save-btn">Save Changes</button>
                </div>
            </form>

            <br />

            <form method="post" action="{{route('donor.changePassword')}}" id="settingsForm" class="settings-form">
                @csrf
                <div class="form-group">
                    <label for="currentPassword">Current Password:</label>
                    <input type="password" id="currentPassword" name="currentPassword">
                    @error('currentPassword')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password:</label>
                    <input type="password" id="newPassword" name="password">
                    @error('password')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="newPassword">Confirm Password:</label>
                    <input type="password" id="newPassword" name="password_confirmation">
                    @error('password_confirmation')
                        <strong style="color: #dc3545">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="settings-save-btn">Change Password</button>
                </div>
            </form>
        </div>
    </section>
@endsection
