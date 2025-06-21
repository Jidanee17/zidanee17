<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_transaksi;
use App\Models\transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = barang::all();
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum('subtotal');

        return view('home', compact('barang', 'cart', 'total'));
    }

    public function addToCart(Request $request) {
        $barang = barang::findOrFail($request->barang);
        $jumlah = $request->jumlah;

        $item = [
            'id' => $barang->id,
            'nama' => $barang->nama,
            'harga' => $barang->harga,
            'jumlah' => $jumlah,
            'subtotal' => $barang->harga * $jumlah
        ];

        $cart = session()->get('cart', []);
        $cart[] = $item;
        session()->put('cart', $cart);

        return redirect()->route('kasir.index');
    }

    public function hapusItem($index) {
        $cart = session()->get('cart', []);
        unset($cart[$index]);
        session()->put('cart', array_values($cart));
        return redirect()->route('kasir.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum('subtotal');

        $transaksi = transaksi::create([
            'total' => $total,
            'bayar' => $request->bayar,
            'kembalian' => $request->kembalian,
            'tanggal' => now()
        ]);

        foreach($cart as $item) {
            detail_transaksi::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $item['id'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal']
            ]);

            $barang = barang::find($item['id']);
            $barang->stok -= $item['jumlah'];
            $barang->save();
        }
        session()->forget('cart');

        return redirect()->route('kasir.cetak', $transaksi->id);
    }

    public function cetak($id) {
        $transaksi = transaksi::with('detail_transaksi')->findOrFail($id);
        $transaksi->tanggal = Carbon::parse($transaksi->tanggal);
        return view('cetak', compact('transaksi'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
