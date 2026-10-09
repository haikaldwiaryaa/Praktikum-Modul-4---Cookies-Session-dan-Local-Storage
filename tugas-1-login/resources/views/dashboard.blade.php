<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <div style="display: flex; gap: 20px; align-items: center;">
        <h2>Dashboard</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">[ Logout ]</button>
        </form>
    </div>
    <hr>
    <p>Selamat datang, {{ Auth::user()->nama_lengkap }}!</p>
    <p>Halaman ini hanya bisa dibuka setelah login.</p>
    <p>Username: {{ Auth::user()->username }}</p>
</body>

</html>