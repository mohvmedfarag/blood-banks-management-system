@extends('layouts.website.auth.auth')
@section('title')
  Patient - Login
@endsection
@section('content')
<main class="continer" style="margin-top: 0">
    <section>
      <h2 style="text-align: center">Login</h2>
      <form id="loginForm" method="post" action="{{route('patient.login')}}">
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
     <a href="{{route('patient.password.email')}}" style="text-decoration: none;">forget password?</a>
          <br />

          <button type="submit" class="button">Login</button>
      </form>
      <br />
     <p style="text-align: center; font-weight:bold;">Not a member? <a href="{{route('patient.register')}}" style="text-decoration: none;">Signup now</a></p>

  </section>
</main>
@endsection