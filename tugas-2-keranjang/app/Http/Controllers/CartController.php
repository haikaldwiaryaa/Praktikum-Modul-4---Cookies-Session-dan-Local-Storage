<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class CartController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $keranjang = session()->get('keranjang', []);
        $totalItem = array_sum($keranjang);

        return view('index', compact('barangs', 'totalItem'));
    }

    public function tambah($id)
    {
        Barang::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]++;
        } else {
            $keranjang[$id] = 1;
        }

        session()->put('keranjang', $keranjang);
        return redirect()->back();
    }

    public function keranjang()
    {
        $keranjang = session()->get('keranjang', []);
        $items = [];
        $total = 0;

        if (!empty($keranjang)) {
            $barangs = Barang::whereIn('id', array_keys($keranjang))->get()->keyBy('id');

            foreach ($keranjang as $id => $jumlah) {
                if (isset($barangs[$id])) {
                    $barang = $barangs[$id];
                    $subtotal = $barang->harga * $jumlah;
                    $total += $subtotal;

                    $items[] = [
                        'barang' => $barang,
                        'jumlah' => $jumlah,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }

        return view('keranjang', compact('items', 'total'));
    }

    public function ubah($id, $aksi)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            if ($aksi === 'tambah') {
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

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('cart.index');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect()->route('cart.index');
    }
}
