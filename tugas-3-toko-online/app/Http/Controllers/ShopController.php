<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $keranjang = session()->get('keranjang', []);
        $totalItem = array_sum($keranjang);

        return view('shop.index', compact('products', 'totalItem'));
    }

    public function tambahKeranjang($id)
    {
        $product = Product::findOrFail($id);

        if ($product->stok <= 0) {
            return back()->with('error', 'Barang ini sedang habis dan tidak dapat dibeli.');
        }

        $keranjang = session()->get('keranjang', []);
        $currentQty = $keranjang[$id] ?? 0;

        if ($currentQty + 1 > $product->stok) {
            return back()->with('error', 'Jumlah pembelian tidak boleh melebihi stok yang tersedia.');
        }

        $keranjang[$id] = $currentQty + 1;
        session()->put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Barang berhasil dimasukkan ke keranjang.');
    }

    public function keranjang()
    {
        $keranjang = session()->get('keranjang', []);
        $items = [];
        $totalHarga = 0;

        if (!empty($keranjang)) {
            $products = Product::whereIn('id_barang', array_keys($keranjang))->get()->keyBy('id_barang');

            foreach ($keranjang as $id => $qty) {
                if (isset($products[$id])) {
                    $product = $products[$id];
                    $subtotal = $product->harga * $qty;
                    $totalHarga += $subtotal;

                    $items[] = [
                        'product' => $product,
                        'qty' => $qty,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }

        return view('shop.keranjang', compact('items', 'totalHarga'));
    }

    public function ubahQty($id, $aksi)
    {
        $product = Product::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            if ($aksi === 'tambah') {
                if ($keranjang[$id] + 1 > $product->stok) {
                    return back()->with('error', 'Jumlah tidak boleh melebihi stok yang ada.');
                }
                $keranjang[$id]++;
            } elseif ($aksi === 'kurang') {
                $keranjang[$id]--;
                if ($keranjang[$id] <= 0) {
                    unset($keranjang[$id]);
                }
            }
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('cart.index');
    }

    public function hapusKeranjang($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('cart.index');
    }

    public function kosongkanKeranjang()
    {
        session()->forget('keranjang');
        return redirect()->route('cart.index');
    }
}
