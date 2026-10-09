<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function checkout()
    {
        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('shop.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        $products = Product::whereIn('id_barang', array_keys($keranjang))->get()->keyBy('id_barang');
        $items = [];
        $totalHarga = 0;

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

        $user = Auth::user();

        return view('orders.checkout', compact('items', 'totalHarga', 'user'));
    }

    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required',
        ]);

        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('shop.index')->with('error', 'Keranjang Anda kosong.');
        }

        $user = Auth::user();

        try {
            DB::beginTransaction();

            $totalHarga = 0;
            $itemsSiapBeli = [];

            foreach ($keranjang as $id => $qty) {
                $product = Product::where('id_barang', $id)->lockForUpdate()->first();

                if (!$product) {
                    throw new \Exception("Produk tidak ditemukan.");
                }

                if ($product->stok < $qty) {
                    throw new \Exception("Stok {$product->nama_barang} tidak mencukupi (tersisa {$product->stok}).");
                }

                $subtotal = $product->harga * $qty;
                $totalHarga += $subtotal;

                $itemsSiapBeli[] = [
                    'product' => $product,
                    'qty' => $qty,
                    'harga' => $product->harga,
                ];
            }

            $id_order = 'ORD-' . strtoupper(Str::random(8));

            Order::create([
                'id_order' => $id_order,
                'id_user' => $user->id_user,
                'tanggal_order' => now(),
                'total_harga' => $totalHarga,
                'alamat_pengiriman' => $request->input('alamat_pengiriman'),
            ]);

            foreach ($itemsSiapBeli as $item) {
                OrderDetail::create([
                    'id_order' => $id_order,
                    'id_barang' => $item['product']->id_barang,
                    'harga_satuan' => $item['harga'],
                    'jumlah_beli' => $item['qty'],
                ]);

                $item['product']->decrement('stok', $item['qty']);
            }

            session()->forget('keranjang');

            DB::commit();

            return redirect()->route('orders.riwayat')->with('success', "Pesanan #{$id_order} berhasil diproses!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }

    public function riwayat()
    {
        $user = Auth::user();
        $orders = Order::with('details.product')
            ->where('id_user', $user->id_user)
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('orders.riwayat', compact('orders'));
    }
}
