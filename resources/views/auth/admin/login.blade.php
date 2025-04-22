@extends('layouts.website.auth.auth')
@section('title')
  Admin - Login
@endsection
@section('content')
<main class="continer" style="margin-top: 0">
    <section>
      <h2 style="text-align: center">Login</h2>
      <form id="loginForm" method="post" action="{{route('admin.login.post')}}">
        @csrf
          <label for="username">Email:</label>
          <input type="text" id="username" name="email">
          @error('email')
            {{$message}}
          @enderror

          <label for="password">Password:</label>
          <input type="password" id="password" name="password">
          @error('password')
          {{$message}}
        @enderror
          <br />

          <button type="submit" class="button">Login</button>
      </form>
      {{-- <a href="{{route('donor.password.email')}}">forget password?</a> --}}
  </section>
</main>
@endsection