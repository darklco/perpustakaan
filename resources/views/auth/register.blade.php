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
    <form method="POST" action="#">
      @csrf
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit">Register</button>
      <p>Sudah punya akun? <a href="{{ route('login_user') }}">Login di sini</a></p>
    </form>
  </div>
</body>
</html>
