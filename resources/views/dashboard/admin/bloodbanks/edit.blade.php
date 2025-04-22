@extends('dashboard.admin.layout.layout.app')
@section('title')
  Admin - Update BloodBank
@endsection
@section('content')
    <!-- Blood Banks Form -->
    <div class="dashboard-container" style="width:60pc">
        <div id="donate" class="tab" style="display: block;">
            <h2 style="text-align: center">Edit Blood Bank</h2>
            <form method="post" action="{{ route('admin.dashboard.bloodbanks.updateBank.post', $bloodbank->id) }}"
                id="donateForm" class="donation-form">
                @csrf

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $bloodbank->name }}">
                @error('name')
                    {{ $message }}
                @enderror

                <label for="governorate">governorate:</label>
                <input type="text" id="governorate" name="governorate" value="{{ $bloodbank->governorate }}">
                @error('governorate')
                    {{ $message }}
                @enderror

                <label for="city">city:</label>
                <input type="text" id="city" name="city" value="{{ $bloodbank->city }}">
                @error('city')
                    {{ $message }}
                @enderror

                <label for="street">street:</label>
                <input type="text" id="street" name="street" value="{{ $bloodbank->street }}">
                @error('street')
                    {{ $message }}
                @enderror

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="{{ $bloodbank->location }}">
                @error('location')
                    {{ $message }}
                @enderror

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="{{ $bloodbank->email }}">
                @error('email')
                    {{ $message }}
                @enderror

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="{{ $bloodbank->phone }}">
                @error('phone')
                    {{ $message }}
                @enderror
                <br />

                <!-- Blood Samples Selection -->
                @php
                    // نفترض أن العلاقة في نموذج BloodBank تعرف كـ bloodSamples
                    $selectedSamples = $bloodbank->blood_samples->pluck('blood-sample')->toArray();
                @endphp

                <label>Available Blood Samples:</label>
                <div>
                    @php
                        $bloodTypes = ['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-'];
                    @endphp
                    @foreach ($bloodTypes as $type)
                        <input type="checkbox" name="blood_samples[]" value="{{ $type }}"
                            {{ in_array($type, $selectedSamples) ? 'checked' : '' }}> {{ $type }}
                    @endforeach
                </div>

                <br />

                <div class="form-group">
                    <button type="submit" class="submit-btn">Add Blood Bank</button>
                </div>
            </form>
        </div>
    </div>
@endsection
