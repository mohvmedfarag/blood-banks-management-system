@extends('layouts.website.auth.auth')
@section('title')
  Donor - Login
@endsection
@section('content')
<main class="continer" style="margin-top: 0">
    <section>
      <h2>Enter Login Information</h2>
      <form id="loginForm" method="post" action="{{route('donor.login')}}">
        @csrf
          <label for="username">Email:</label>
          <input type="text" id="username" name="email" value="{{old('email')}}">
         @error('email')
              <p class="text-danger">{{$message}}</p> 
         @enderror

          <label for="password">Password:</label>
          <input type="password" id="password" name="password">
          @error('password')
          <p class="text-danger">{{$message}}</p> 
     @enderror
     <a href="{{route('donor.password.email')}}" style="text-decoration: none;">forget password?</a>
          <br />

          <button type="submit" class="button">Login</button>
      </form>
      <br />
      <p style="text-align: center; font-weight:bold;">Not a member? <a href="{{route('donor.register')}}" style="text-decoration: none;">Signup now</a></p>

  </section>
</main>
@endsection