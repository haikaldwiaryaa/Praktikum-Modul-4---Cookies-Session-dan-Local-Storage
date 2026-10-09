<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <p>Masuk untuk membuka dashboard</p>

    @if ($errors->has('login_error'))
        <p style="color: red;">[ {{ $errors->first('login_error') }} ]</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>Username</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required>
        </div>
        <div style="margin-top: 10px;">
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>
        <div style="margin-top: 15px;">
            <button type="submit">Masuk</button>
        </div>
    </form>
</body>

</html>