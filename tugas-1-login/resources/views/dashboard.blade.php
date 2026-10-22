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
    <p>Username: {{ Auth::user()->username }} | Role: <strong>{{ Auth::user()->role }}</strong></p>

    @if (session('status'))
        <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 15px;">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; margin-bottom: 15px;">
            {{ $errors->first() }}
        </div>
    @endif

    <hr>
    <h3>Manajemen Role User</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Role Saat Ini</th>
                <th>Aksi Ubah Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->nama_lengkap }}</td>
                    <td><strong>{{ $u->role }}</strong></td>
                    <td>
                        <form action="{{ route('admin.users.role.update', $u->id) }}" method="POST" style="display: inline-flex; gap: 5px;">
                            @csrf
                            @method('PATCH')
                            <select name="role">
                                <option value="customer" {{ $u->role === 'customer' ? 'selected' : '' }}>customer</option>
                                <option value="staff" {{ $u->role === 'staff' ? 'selected' : '' }}>staff</option>
                                <option value="admin">admin (uji coba ilegal)</option>
                            </select>
                            <button type="submit">Ubah Role</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <h3>Simulasi Fitur Keranjang (W06)</h3>
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <button type="submit">Uji Coba POST /cart/add</button>
    </form>
</body>

</html>