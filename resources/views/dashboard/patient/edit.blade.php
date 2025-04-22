@extends('dashboard.patient.layout.app')
@section('title')
  Patient - Edit Request
@endsection
@section('content')
    <!-- Blood Donation Form -->
    <div id="donate" class="tab" style="display: block; width:60%; margin:0 auto">
        <h2 style="text-align: center">Request Blood</h2>
        <form method="post" action="{{route('patient.requests.show.edit.post', $req->id)}}" id="donateForm" class="donation-form">
            @csrf
            <label for="bloodType">Blood Type:</label>
            <select id="bloodType" name="blood_type">
                <option value="{{$req->blood_type}}">{{$req->blood_type}}</option>
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
            <input type="text" id="quantity" name="quantity" value="{{$req->quantity}}">
            @error('quantity')
            {{$message}}
        @enderror

            <label for="donationType">Donation Type:</label>
            <select id="donationType" name="request_type">
                <option value="Plasma">{{$req->request_type}}</option>
                <option value="">optional</option>
                <option value="full_blood">Full Blood</option>
                <option value="Plasma">Plasma</option>
                <option value="Platelets">Platelets</option>
            </select>
            @error('request_type')
            {{$message}}
        @enderror

            
            <label for="bloodbank">Blood Bank:</label>
            <select id="bloodbank" name="bloodbank_id">
                <option value="{{$req->bloodbank_id}}">{{$req->bloodbank->name}}</option>
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
