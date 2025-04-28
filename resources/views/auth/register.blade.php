<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="register-page">
  <div class="form-container">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register.submit') }}">

      @csrf
      <input type="text" name="name" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
      <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
    </form>
  </div>
</body>
</html>
