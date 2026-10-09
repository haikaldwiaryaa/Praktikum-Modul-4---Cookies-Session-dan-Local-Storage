@extends('layouts.app')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <h2>Keranjang Belanja</h2>
        <a href="{{ route('shop.index') }}" class="btn btn-secondary btn-sm">&laquo; Lanjut Belanja</a>
    </div>

    @if (empty($items))
        <div style="text-align: center; padding: 40px 0;">
            <p style="color: #64748b; font-size: 1.1rem; margin-bottom: 16px;">Keranjang belanja Anda masih kosong.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary">Mulai Belanja</a>
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <strong>{{ $item['product']->nama_barang }}</strong><br>
                            <span style="font-size: 0.8rem; color: #64748b;">Maksimal stok: {{ $item['product']->stok }}</span>
                        </td>
                        <td>Rp {{ number_format($item['product']->harga, 0, ',', '.') }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <a href="{{ route('cart.ubah', ['id' => $item['product']->id_barang, 'aksi' => 'kurang']) }}" class="btn btn-secondary btn-sm">-</a>
                                <span style="font-weight: 700; min-width: 20px; text-align: center;">{{ $item['qty'] }}</span>
                                <a href="{{ route('cart.ubah', ['id' => $item['product']->id_barang, 'aksi' => 'tambah']) }}" class="btn btn-secondary btn-sm" {{ $item['qty'] >= $item['product']->stok ? 'style=pointer-events:none;opacity:0.5' : '' }}>+</a>
                            </div>
                        </td>
                        <td>
                            <strong>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('cart.hapus', $item['product']->id_barang) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus item ini?')">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 24px; padding-top: 16px; border-top: 2px solid #e2e8f0;">
            <div>
                <a href="{{ route('cart.kosongkan') }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin mengosongkan seluruh keranjang?')">Kosongkan Keranjang</a>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 1.1rem; color: #475569;">Total Pembayaran:</p>
                <h3 style="font-size: 1.6rem; color: #0284c7; margin-bottom: 12px;">Rp {{ number_format($totalHarga, 0, ',', '.') }}</h3>
                <a href="{{ route('order.checkout') }}" class="btn btn-success" style="font-size: 1rem; padding: 10px 24px;">Lanjut ke Checkout &raquo;</a>
            </div>
        </div>
    @endif
</div>
@endsection
