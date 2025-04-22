@extends('dashboard.admin.layout.layout.app')
@section('title')
    Admin - Create BloodBank
@endsection
@section('content')
    <!-- Blood Banks Form -->
    <div class="dashboard-container" style="width:60pc">
        <div id="donate" class="tab" style="display: block;">
            <h2 style="text-align: center">Create Blood Bank</h2>
            <form method="post" action="{{ route('admin.dashboard.bloodbanks.create.post') }}" id="donateForm"
                class="donation-form">
                @csrf

                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
                @error('name')
                    {{ $message }}
                @enderror

                <label for="governorate">Governorate:</label>
                <select id="governorate" name="governorate">
                    <option value="">-- Select Governorate --</option>
                    @php
                        $governorates = [
                            'Cairo',
                            'Giza',
                            'Alexandria',
                            'Beheira',
                            'Kafr El Sheikh',
                            'Dakahlia',
                            'Damietta',
                            'Port Said',
                            'Suez',
                            'Ismailia',
                            'Sharqia',
                            'Gharbia',
                            'Monufia',
                            'Qalyubia',
                            'Beni Suef',
                            'Minya',
                            'Fayoum',
                            'Asyut',
                            'Sohag',
                            'Qena',
                            'Luxor',
                            'Aswan',
                            'Red Sea',
                            'New Valley',
                            'Matrouh',
                            'North Sinai',
                            'South Sinai',
                        ];
                    @endphp

                    @foreach ($governorates as $gov)
                        <option value="{{ $gov }}" {{ old('governorate') === $gov ? 'selected' : '' }}>
                            {{ $gov }}
                        </option>
                    @endforeach
                </select>
                @error('governorate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror


                <label for="city">city:</label>
                <input type="text" id="city" name="city">
                @error('city')
                    {{ $message }}
                @enderror

                <label for="street">street:</label>
                <input type="text" id="street" name="street">
                @error('street')
                    {{ $message }}
                @enderror

                <label for="location">Location:</label>
                <input type="text" id="location" name="location">
                @error('location')
                    {{ $message }}
                @enderror

                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
                @error('email')
                    {{ $message }}
                @enderror

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">
                @error('phone')
                    {{ $message }}
                @enderror
                <br />

                <!-- Blood Samples Selection -->
                <label>Available Blood Samples:</label>
                <div>
                    @php
                        $bloodTypes = ['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-'];
                    @endphp
                    @foreach ($bloodTypes as $type)
                        <input type="checkbox" name="blood_samples[]" value="{{ $type }}"> {{ $type }}
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
