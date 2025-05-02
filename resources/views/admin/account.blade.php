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
        }
        .container {
            max-width: 700px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 15px;
        }
        .info label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
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
        }
        .logout-btn {
            background-color: #dc2626;
        }
        .logout-btn:hover {
            background-color: #b91c1c;
        }
        .back-btn {
            background-color: #3b82f6;
        }
        .back-btn:hover {
            background-color: #2563eb;
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

        <a href="{{ route('DashboardAdmin') }}" class="back-btn">Kembali ke Beranda</a>
    </div>
</body>
</html>
