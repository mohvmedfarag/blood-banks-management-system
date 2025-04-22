@extends('dashboard.donor.layout.app')
@section('title')
  Donor - New Donate
@endsection
@section('content')
    <!-- Blood Donation Form -->
    <div class="dashboard-container" style="margin: 0; width:60pc">
        <div id="donate" class="tab" style="display: block;">
            <h2 style="text-align: center">Donate Blood</h2>
            <form method="post" action="{{route('donor.new.donate.post')}}" id="donateForm" class="donation-form">
                @csrf
                <label for="bloodType">Blood Type:</label>
                <select id="bloodType" name="blood_type">
                    <option value="">Optional</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
    
                <label for="quantity">Quantity:</label>
                <input type="text" id="quantity" name="quantity" min="1">
    
                <label for="donationType">Donation Type:</label>
                <select id="donationType" name="donation_type">
                    <option value="">optional</option>
                    <option value="Whole Blood">Full Blood</option>
                    <option value="Plasma">Plasma</option>
                    <option value="Platelets">Platelets</option>
                </select>
    
                <label for="donation_date">Donation Date:</label>
                <input type="text" id="donation_date" name="donation_date" min="1">
                
                <label for="bloodbank">Blood Bank:</label>
                <select id="bloodbank" name="bloodbank_id">
                    @foreach ($bloodbanks as $bank)
                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                    @endforeach
                </select>
               
    
              
                <div class="form-group">
                    <button type="submit" class="submit-btn">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection
