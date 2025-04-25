<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-page">
  <div class="form-container">
    <h2>Login</h2>
    <form method="POST" action="#">
      @csrf
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">login</button>
      <p>Belum punya akun? <a href="{{ route('register') }}">Register di sini</a></p>
    </form>
  </div>
</body>
</html>
