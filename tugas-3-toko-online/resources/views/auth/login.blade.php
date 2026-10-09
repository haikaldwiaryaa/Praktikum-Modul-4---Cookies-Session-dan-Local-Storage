@extends('layouts.app')

@section('content')
<div style="max-width: 420px; margin: 40px auto;">
    <div class="card">
        <h2 style="margin-bottom: 8px;">Login Pengguna</h2>
        <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 20px;">Silakan masuk untuk berbelanja dan checkout barang.</p>

        @if ($errors->has('login_error'))
            <div class="alert alert-danger" style="padding: 8px 12px; font-size: 0.9rem;">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 4px;">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required style="width: 100%; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 4px;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Masuk</button>
        </form>

        <div style="margin-top: 15px; font-size: 0.85rem; color: #64748b; text-align: center;">
            <p>Akun Demo: Username: <code>haikal</code> | Password: <code>password123</code></p>
        </div>
    </div>
</div>
@endsection
