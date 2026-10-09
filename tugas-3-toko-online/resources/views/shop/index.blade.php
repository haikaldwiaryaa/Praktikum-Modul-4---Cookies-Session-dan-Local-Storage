@extends('layouts.app')

@section('content')
<div style="margin-bottom: 24px;">
    <h2>Daftar Barang Tersedia</h2>
    <p style="color: #64748b; font-size: 0.95rem;">Temukan aneka peralatan tulis dan kantor berkualitas dengan harga terjangkau.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px;">
    @foreach ($products as $p)
        <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div style="background: #f1f5f9; height: 160px; border-radius: 6px; overflow: hidden; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                    <img src="{{ asset('images/products/' . $p->gambar) }}" alt="{{ $p->nama_barang }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.05rem; margin-bottom: 6px;">{{ $p->nama_barang }}</h3>
                <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 10px;">{{ $p->deskripsi }}</p>
            </div>
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                    <span style="font-size: 1.1rem; font-weight: 700; color: #0284c7;">
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </span>
                    <span style="font-size: 0.85rem; font-weight: 600; color: {{ $p->stok > 0 ? '#16a34a' : '#dc2626' }};">
                        {{ $p->stok > 0 ? 'Stok: ' . $p->stok : 'Stok Habis' }}
                    </span>
                </div>

                @if ($p->stok > 0)
                    <a href="{{ route('cart.tambah', $p->id_barang) }}" class="btn btn-primary" style="display: block; text-align: center;">
                        + Masukkan Keranjang
                    </a>
                @else
                    <button class="btn btn-disabled" style="display: block; width: 100%;" disabled>
                        Tidak Dapat Dibeli
                    </button>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
