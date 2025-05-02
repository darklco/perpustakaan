<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informasi Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6; 
            padding: 20px;
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }

        .container {
            max-width: 700px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%; 
        }

        h2 {
            margin-bottom: 20px;
            color: #6b4c3b; 
        }

        .info {
            margin-bottom: 15px;
        }

        .info label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #6b4c3b;
        }

        .info div {
            color: #6b4c3b; 
        }

        .logout-btn,
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            margin-right: 10px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .logout-btn {
            background-color: #6b4c3b; 
        }

        .logout-btn:hover {
            background-color: #5a3f2f; 
        }

        .back-btn {
            background-color: #6b4c3b; 
        }

        .back-btn:hover {
            background-color: #5a3f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Informasi Akun</h2>

        <div class="info">
            <label>Nama Lengkap:</label>
            <div>{{ Auth::user()->name }}</div>
        </div>

        <div class="info">
            <label>Email:</label>
            <div>{{ Auth::user()->email }}</div>
        </div>

        <div class="info">
            <label>Role:</label>
            <div>{{ Auth::user()->role }}</div>
        </div>

        <div class="info">
            <label>Tanggal Gabung:</label>
            <div>{{ Auth::user()->created_at->format('d M Y') }}</div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>

        <a href="{{ route('index') }}" class="back-btn">Kembali ke Beranda</a>
    </div>
</body>
</html>
