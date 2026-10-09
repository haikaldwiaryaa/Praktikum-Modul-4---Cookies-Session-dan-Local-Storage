@extends('layouts.app')

@section('content')
<div style="margin-bottom: 24px;">
    <h2>Riwayat Pesanan Saya</h2>
    <p style="color: #64748b; font-size: 0.95rem;">Daftar transaksi dan detail pesanan yang berhasil Anda checkout.</p>
</div>

@if ($orders->isEmpty())
    <div class="card" style="text-align: center; padding: 40px 0;">
        <p style="color: #64748b; font-size: 1.1rem; margin-bottom: 16px;">Anda belum memiliki riwayat pesanan.</p>
        <a href="{{ route('shop.index') }}" class="btn btn-primary">Mulai Belanja</a>
    </div>
@else
    @foreach ($orders as $order)
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 12px;">
                <div>
                    <h3 style="font-size: 1.1rem; color: #0284c7;">No. Pesanan: {{ $order->id_order }}</h3>
                    <p style="color: #64748b; font-size: 0.85rem;">Waktu Checkout: {{ \Carbon\Carbon::parse($order->tanggal_order)->translatedFormat('d F Y, H:i') }} WIB</p>
                    <p style="color: #64748b; font-size: 0.85rem; margin-top: 4px;">Alamat Tujuan: <em>{{ $order->alamat_pengiriman }}</em></p>
                </div>
                <div style="text-align: right;">
                    <span style="font-size: 0.85rem; color: #64748b;">Total Bayar</span>
                    <h4 style="font-size: 1.25rem; color: #16a34a;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h4>
                </div>
            </div>

            <h4 style="font-size: 0.95rem; margin-bottom: 8px; color: #475569;">Detail Produk yang Dibeli:</h4>
            <table class="table" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga Saat Beli</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->details as $d)
                        <tr>
                            <td>{{ $d->product->nama_barang ?? 'Barang #' . $d->id_barang }}</td>
                            <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                            <td>{{ $d->jumlah_beli }}</td>
                            <td>Rp {{ number_format($d->harga_satuan * $d->jumlah_beli, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
@endif
@endsection
