<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; max-width: 600px; margin: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 15px; }
        .item-box { margin-bottom: 15px; border-bottom: 1px dashed #ccc; padding-bottom: 10px; }
        .item-name { font-weight: bold; margin-bottom: 4px; }
        .item-control { display: flex; justify-content: space-between; align-items: center; }
        .btn { padding: 3px 8px; background: #eee; border: 1px solid #999; text-decoration: none; color: #000; border-radius: 3px; font-size: 13px; }
        .btn:hover { background: #ddd; }
        .total-box { display: flex; justify-content: space-between; font-size: 18px; font-weight: bold; margin: 20px 0 10px; border-top: 2px solid #333; padding-top: 10px; }
        .nav-links { display: flex; justify-content: space-between; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Keranjang belanja</h2>
        <span>Tanpa login</span>
    </div>

    @if (empty($items))
        <p>Keranjang masih kosong.</p>
        <div style="margin-top: 15px;">
            <a href="{{ route('produk.index') }}" class="btn">&laquo; Kembali ke Daftar Barang</a>
        </div>
    @else
        <div>
            @foreach ($items as $item)
                <div class="item-box">
                    <div class="item-name">{{ $item['barang']->nama }}</div>
                    <div class="item-control">
                        <span>
                            Rp {{ number_format($item['barang']->harga, 0, ',', '.') }} x {{ $item['jumlah'] }} = 
                            <strong>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
                        </span>
                        <div>
                            <a href="{{ route('cart.ubah', ['id' => $item['barang']->id, 'aksi' => 'kurang']) }}" class="btn">[-]</a>
                            <span style="padding: 0 5px;">{{ $item['jumlah'] }}</span>
                            <a href="{{ route('cart.ubah', ['id' => $item['barang']->id, 'aksi' => 'tambah']) }}" class="btn">[+]</a>
                            <a href="{{ route('cart.hapus', $item['barang']->id) }}" class="btn" style="color: red;">[hps]</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="total-box">
            <span>Total</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <div class="nav-links">
            <a href="{{ route('cart.kosongkan') }}" class="btn" onclick="return confirm('Kosongkan keranjang?')">[ Kosongkan keranjang ]</a>
            <a href="{{ route('produk.index') }}" class="btn">&laquo; Lanjut Belanja</a>
        </div>
    @endif
</body>
</html>
