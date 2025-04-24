@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css1/registerr.css') }}">

<div class="register-container">
    <h2>Register</h2>
    <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
        <button type="submit">Register</button>
        <p>Sudah punya akun? <a href="{{ route('login_user') }}">Login di sini</a></p>
    </form>
</div>
@endsection
