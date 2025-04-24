@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css1/login_user.css') }}">

<div class="login-container">
    <h2>Login User</h2>
    <form action="{{ route('login_user.submit') }}" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </form>
</div>
@endsection
