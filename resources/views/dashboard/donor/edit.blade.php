@extends('dashboard.donor.layout.app')
@section('title')
  Donor - Edit Donation
@endsection
@section('content')
    <!-- Blood Donation Form -->
    <div id="donate" class="tab" style="display: block; width:60%; margin:0 auto">
        <h2 style="text-align: center">Donate Blood</h2>
        <form method="post" action="{{route('donor.donation.show.edit.post', $donate->id)}}" id="donateForm" class="donation-form">
            @csrf
            <label for="bloodType">Blood Type:</label>
            <select id="bloodType" name="blood_type">
                <option value="{{$donate->blood_type}}">{{$donate->blood_type}}</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>

            @error('blood_type')
                {{$message}}
            @enderror

            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" value="{{$donate->quantity}}">
            @error('quantity')
            {{$message}}
        @enderror

            <label for="donationType">Donation Type:</label>
            <select id="donationType" name="donation_type">
                <option value="plasma">{{$donate->donation_type}}</option>
                <option value="">optional</option>
                <option value="full_blood">Full Blood</option>
                <option value="plasma">Plasma</option>
                <option value="platelets">Platelets</option>
            </select>
            @error('donation_type')
            {{$message}}
        @enderror

            <label for="donation_date">Donation Date:</label>
            <input type="text" id="donation_date" name="donation_date" value="{{$donate->donation_date}}">
            @error('donation_date')
            {{$message}}
        @enderror
            
            <label for="bloodbank">Blood Bank:</label>
            <select id="bloodbank" name="bloodbank_id">
                <option value="{{$donate->bloodbank_id}}">{{$donate->bloodbank->name}}</option>
                @foreach ($bloodbanks as $bank)
                <option value="{{$bank->id}}">{{$bank->name}}</option>
                @endforeach
            </select>
            @error('bloodbank_id')
            {{$message}}
        @enderror

          
            <div class="form-group">
                <button type="submit" class="submit-btn">Send</button>
            </div>
        </form>
    </div>
@endsection
