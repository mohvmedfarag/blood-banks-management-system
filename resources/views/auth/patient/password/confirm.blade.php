@extends('layouts.website.auth.auth')
@section('title')
  Patient - Verify
@endsection
@section('content')
<main class="continer" style="margin-top: 0">
    <section>
      <h2>Enter Code</h2>
      <form id="loginForm" method="post" action="{{route('patient.password.verify.post')}}">
        @csrf
        <input type="email" hidden name="email" value="{{$email}}">
          <input type="text" id="username" name="otp">
         @error('otp')
              <p class="text-danger">{{$message}}</p> 
         @enderror

          <br />

          <button type="submit" class="button">Check</button>
      </form>
  </section>
</main>
@endsection