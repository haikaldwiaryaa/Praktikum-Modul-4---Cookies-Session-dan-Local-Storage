<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; max-width: 600px; margin: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 15px; }
        .item-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding: 8px 0; border-bottom: 1px dashed #ccc; }
        .btn { padding: 5px 10px; background: #eee; border: 1px solid #999; text-decoration: none; color: #000; border-radius: 3px; }
        .btn:hover { background: #ddd; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Toko Alat Tulis</h2>
        <a href="{{ route('cart.index') }}" class="btn">Keranjang ({{ $totalItem }})</a>
    </div>

    <h3>Daftar barang</h3>
    <div>
        @foreach ($barangs as $b)
            <div class="item-row">
                <div>
                    <strong>[img] {{ $b->nama }}</strong><br>
                    <span>Rp {{ number_format($b->harga, 0, ',', '.') }}</span>
                </div>
                <div>
                    <a href="{{ route('cart.tambah', $b->id) }}" class="btn">Masukkan ke krj</a>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
