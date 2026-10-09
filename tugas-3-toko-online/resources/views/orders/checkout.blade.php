@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 700px; margin: 0 auto;">
    <h2 style="margin-bottom: 8px;">Konfirmasi Checkout</h2>
    <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 20px;">Periksa kembali daftar pesanan dan pastikan alamat pengiriman sudah benar.</p>

    <h3 style="font-size: 1.05rem; margin-bottom: 10px; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px;">Ringkasan Barang</h3>
    <table class="table" style="margin-bottom: 20px;">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['product']->nama_barang }}</td>
                    <td>Rp {{ number_format($item['product']->harga, 0, ',', '.') }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr style="background: #f8fafc; font-weight: 700;">
                <td colspan="3" style="text-align: right;">Total Bayar (Ongkir Rp 0):</td>
                <td style="color: #0284c7; font-size: 1.1rem;">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <form method="POST" action="{{ route('order.prosesCheckout') }}">
        @csrf
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; font-size: 0.95rem; margin-bottom: 6px;">Alamat Pengiriman</label>
            <textarea name="alamat_pengiriman" rows="3" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;">{{ old('alamat_pengiriman', $user->alamat) }}</textarea>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('cart.index') }}" class="btn btn-secondary">&laquo; Kembali ke Keranjang</a>
            <button type="submit" class="btn btn-success" style="padding: 10px 24px; font-size: 1rem;">
                Proses Pembelian Sekarang &raquo;
            </button>
        </div>
    </form>
</div>
@endsection
