@extends('layouts.website.auth.auth')
@section('title')
    Admin - Login
@endsection
<style>
    body {
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f4f4f9;
        font-family: Arial, sans-serif;
    }

    /* ستايل الكونتينر */
    .login-container {
        width: 400px;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .login-container h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .login-container form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .login-container label {
        text-align: left;
        font-weight: bold;
        color: #333;
        font-size: 14px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .button {
        padding: 10px 20px;
        background-color: #8d1e1e;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 15px;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #600b0b;
    }

    .forget-link {
        font-size: 13px;
        color: #8d1e1e;
        text-decoration: none;
        text-align: left;
    }

    .forget-link:hover {
        text-decoration: underline;
    }

    /* لينك التسجيل */
    .signup-link {
        margin-top: 15px;
        font-size: 14px;
        font-weight: bold;
    }

    .signup-link a {
        color: #8d1e1e;
        text-decoration: none;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    .text-danger {
        color: red;
        font-size: 12px;
        text-align: left;
    }
</style>
@section('content')
    <main class="continer" style="margin-top: 0">
        <section class="login-container">
            <h2 style="text-align: center">Login</h2>
            <form id="loginForm" method="post" action="{{ route('admin.login.post') }}">
                @csrf
                <label for="username">Email:</label>
                <input type="text" id="username" name="email">
                @error('email')
                    {{ $message }}
                @enderror

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                @error('password')
                    {{ $message }}
                @enderror


                <button type="submit" class="button">Login</button>
            </form>
            {{-- <a href="{{route('donor.password.email')}}">forget password?</a> --}}
        </section>
    </main>
@endsection
