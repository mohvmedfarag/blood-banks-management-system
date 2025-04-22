@extends('layouts.website.auth.auth')
@section('title')
  Donor - Verify 
@endsection
@section('content')
<main class="continer" style="margin-top: 0">
    <section>
      @if (session()->has('email'))
        {{session()->get('email')}}
      @endif
      <h2>Enter Your Email</h2>
      <form id="loginForm" method="post" action="{{route('donor.password.email.post')}}">
        @csrf
          <input type="text" id="username" name="email" value="{{old('email')}}">
         @error('email')
              <p class="text-danger">{{$message}}</p> 
         @enderror

          <br />

          <button type="submit" class="button">Send Otp</button>
      </form>
  </section>
</main>
@endsection