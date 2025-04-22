
@extends('layouts.website.auth.auth')
@section('title')
  Donor - Verify
@endsection
@section('content')
<main class="continer" style="margin-top: 0">
    <section>
      <h2>Confirm Password</h2>
      <form id="loginForm" method="post" action="{{route('donor.password.reset.post')}}">
        @csrf
        <input type="email" hidden name="email" value="{{$email}}">

          <label for="password">Password:</label>
          <input type="password" id="password" name="password">
          @error('password')
          <p class="text-danger">{{$message}}</p> 
     @enderror

     <label for="password">Password:</label>
          <input type="password" id="password" name="password_confirmation">
          @error('password_confirmation')
          <p class="text-danger">{{$message}}</p> 
     @enderror
          <br />

          <button type="submit" class="button">Verify</button>
      </form>
  </section>
</main>
@endsection