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

    public function addToCart(Request $request)
    {
        // Pastikan nama Model sesuai dengan yang ada di project (barang/Barang)
        $barang = barang::findOrFail($request->barang);
        $jumlah = $request->jumlah;

        // 1. Ambil persentase diskon dari database (misal: 50 untuk 50%)
        $persenDiskon = $barang->diskon ?? 0;

        // 2. Hitung NOMINAL diskon dalam rupiah untuk pengurangan harga
        // Rumus: (30.000 x 50) / 100 = 15.000
        $nominalDiskon = ($barang->harga * $persenDiskon) / 100;

        // 3. Hitung harga setelah diskon
        // Contoh: 30.000 - 15.000 = 15.000
        $hargaSetelahDiskon = max($barang->harga - $nominalDiskon, 0);

        $item = [
            'id' => $barang->id,
            'nama' => $barang->nama,
            'harga' => $barang->harga,

            // --- PERBAIKAN DI SINI ---
            // Simpan PERSENTASE ke key 'diskon' agar di tabel muncul angka "50" (bukan 15000)
            'diskon' => $persenDiskon,

            // (Opsional) Kita simpan nominal potongan di key lain jika nanti butuh laporan
            'potongan_rupiah' => $nominalDiskon,

            'jumlah' => $jumlah,

            // Subtotal tetap dihitung dari harga bersih * jumlah
            'subtotal' => $hargaSetelahDiskon * $jumlah
        ];

        $cart = session()->get('cart', []);

        // Tambahkan item sebagai baris baru
        // Catatan: Logika ini membuat baris baru setiap klik (tidak menggabungkan qty)
        $cart[] = $item;

        session()->put('cart', $cart);

        return redirect()->route('kasir.index');
    }




    public function hapusItem($index)
    {
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

        foreach ($cart as $item) {
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

    public function cetak($id)
    {
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
