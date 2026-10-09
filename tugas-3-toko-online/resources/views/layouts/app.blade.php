<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Tulis Online</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background: #f8fafc; color: #1e293b; line-height: 1.5; }
        .navbar { background: #0f172a; color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        .navbar-brand { font-size: 1.25rem; font-weight: 700; color: #38bdf8; text-decoration: none; }
        .nav-links { display: flex; gap: 16px; align-items: center; }
        .nav-links a { color: #e2e8f0; text-decoration: none; font-size: 0.95rem; }
        .nav-links a:hover { color: #38bdf8; }
        .nav-btn { background: #0284c7; color: white; padding: 6px 14px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-size: 0.9rem; }
        .nav-btn:hover { background: #0369a1; }
        .badge { background: #ef4444; color: white; padding: 2px 7px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; }
        .container { max-width: 960px; margin: 24px auto; padding: 0 16px; }
        .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 0.95rem; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-danger { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .card { background: white; border-radius: 8px; border: 1px solid #e2e8f0; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        .table th, .table td { padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        .table th { background: #f1f5f9; font-weight: 600; }
        .btn { display: inline-block; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 0.9rem; cursor: pointer; border: 1px solid transparent; }
        .btn-primary { background: #0284c7; color: white; }
        .btn-primary:hover { background: #0369a1; }
        .btn-success { background: #16a34a; color: white; }
        .btn-success:hover { background: #15803d; }
        .btn-danger { background: #dc2626; color: white; }
        .btn-secondary { background: #e2e8f0; color: #334155; }
        .btn-secondary:hover { background: #cbd5e1; }
        .btn-sm { padding: 4px 10px; font-size: 0.85rem; }
        .btn:disabled, .btn-disabled { background: #cbd5e1; color: #64748b; cursor: not-allowed; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('shop.index') }}" class="navbar-brand">ATK Store</a>
        <div class="nav-links">
            <a href="{{ route('shop.index') }}">Katalog Produk</a>
            @auth
                <a href="{{ route('cart.index') }}">
                    Keranjang
                    @php $totalQty = array_sum(session()->get('keranjang', [])); @endphp
                    @if($totalQty > 0)
                        <span class="badge">{{ $totalQty }}</span>
                    @endif
                </a>
                <a href="{{ route('orders.riwayat') }}">Riwayat Pesanan</a>
                <span style="color: #94a3b8; font-size: 0.9rem;">Hai, <strong>{{ Auth::user()->nama_lengkap }}</strong></span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-btn">Login</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
