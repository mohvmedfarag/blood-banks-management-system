@extends('layouts.website.auth.auth')
@section('title')
  Donor - Register
@endsection
@section('content')
<main class="continer">
    <section class="signup-container" style="margin: 35px auto">
        <h2>Register</h2>
        <form id="signupForm" method="post" action="{{route('donor.register')}}">
            @csrf
            <!-- Name -->
            <label for="firstName">Name:</label>
            <input type="text" id="firstName" name="name" value="{{old('name')}}">
            @error('name')
                <strong class="text-danger">{{$message}}</strong>
            @enderror

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{old('email')}}">
            @error('email')
                <strong class="text-danger">{{$message}}</strong>
            @enderror

            <!-- Phone Number -->
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="{{old('phone')}}">
            @error('phone')
                <strong class="text-danger">{{$message}}</strong>
            @enderror

            <!-- National ID -->
            <label for="nationalId">Address:</label>
            <input type="text" id="nationalId" name="address" value="{{old('address')}}">
            @error('address')
                <strong class="text-danger">{{$message}}</strong>
            @enderror

            <!-- Date of Birth -->
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="{{old('age')}}">
            @error('age')
                <strong class="text-danger">{{$message}}</strong>
            @enderror

            <label for="weight">Weight:</label>
            <input type="number" id="weight" name="weight" value="{{old('weight')}}">
            @error('weight')
                <strong class="text-danger">{{$message}}</strong>
            @enderror

            <div>
            <label for="gender">Gender:</label>
            <input type="radio" name="gender" value="male" >
            Male
            <input type="radio" name="gender" value="female" >
            Female
            </div>
            @error('gender')
                <strong class="text-danger">{{$message}}</strong>
            @enderror
                

            <!-- Password -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            @error('password')
                <strong class="text-danger">{{$message}}</strong>
            @enderror

            <!-- Confirm Password -->
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="password_confirmation">
            @error('password_confirmation')
                <strong class="text-danger">{{$message}}</strong>
            @enderror

            <br/>

            <!-- Submit Button -->
            <button type="submit" class="button">Register</button>
        </form>
        
    </section>
</main>
@endsection