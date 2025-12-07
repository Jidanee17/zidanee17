<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        // 1. Inisialisasi Query
        $query = Barang::query();

        // 2. Logika Pencarian
        // Cek jika ada input 'search' dari form
        if ($request->has('search') && $request->filled('search')) {
            $keyword = $request->search;
            
            // Filter berdasarkan Nama Barang ATAU Kode Barang
            // Menggunakan LIKE %...% agar bisa mencari potongan kata
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('kode', 'LIKE', '%' . $keyword . '%');
            });
        }

        // 3. Ambil Data
        // OrderBy dibuat 'desc' agar data terbaru muncul di atas
        $barang = $query->orderBy('created_at', 'desc')->get(); 

        // 4. Return ke View dengan membawa variabel $barang
        return view('barang', compact('barang'));
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
    $validatedData = $request->validate([
        'kode' => 'required|unique:barang,kode', 
        'nama' => 'required|unique:barang,nama',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
        // --- TAMBAHAN: Validasi Diskon ---
        'diskon' => 'nullable|numeric|min:0|max:100', 
    ], [
        'kode.unique' => 'Kode barang sudah terdaftar.',
        'nama.unique' => 'Nama barang sudah ada.',
        // --- TAMBAHAN: Pesan Error Diskon ---
        'diskon.max' => 'Diskon tidak boleh lebih dari 100%.',
    ]);

    // --- TAMBAHAN: Set default diskon ke 0 jika kosong ---
    if (!isset($validatedData['diskon'])) {
        $validatedData['diskon'] = 0;
    }

    Barang::create($validatedData);

    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
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
        $barang = barang::find($id);
        return view('barang-edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'kode' => 'required|unique:barang,kode,'.$id, 
        'nama' => 'required|unique:barang,nama,'.$id,
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
        // --- TAMBAHAN: Validasi Diskon ---
        'diskon' => 'nullable|numeric|min:0|max:100',
    ]);

    // --- TAMBAHAN: Set default diskon ---
    if (!isset($validatedData['diskon'])) {
        $validatedData['diskon'] = 0;
    }

    Barang::where('id', $id)->update($validatedData);
    return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
}
    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
    {
        Barang::destroy($id);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
