<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\BarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InventarisController extends Controller
{
    public function dashboard()
    {
        $totalBarang = Barang::count();
        $barangBaik = Barang::where('kondisi', 'Baik')->count();
        $barangDipinjam = Barang::where('kondisi', 'Dipinjam')->count();
        $barangRusak = Barang::where('kondisi', 'Rusak')->count();
        
        $barangTerbaru = Barang::latest()->take(5)->get();
        
        return view('dashboard', compact('totalBarang', 'barangBaik', 'barangDipinjam', 'barangRusak', 'barangTerbaru'));
    }

    public function index(Request $request)
    {
        $query = Barang::query();
        
        if ($request->filled('cari')) {
            $query->where('nama_barang', 'like', '%' . $request->cari . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->cari . '%');
        }
        
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }
        
        $barang = $query->latest()->paginate(10)->withQueryString();
        return view('inventaris.daftarBarang', compact('barang'));
    }

    public function create()
    {
        return view('inventaris.tambahBarang');
    }

    public function store(BarangRequest $request)
    {
        $validated = $request->validated();
        
        // Generate Kode Barang (IT-0001)
        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $nextId = $lastBarang ? $lastBarang->id + 1 : 1;
        $validated['kode_barang'] = 'IT-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto', 'public');
        }
        
        if ($request->hasFile('file_manual')) {
            $validated['file_manual'] = $request->file('file_manual')->store('file', 'public');
        }
        
        Barang::create($validated);
        
        return redirect()->route('inventaris.index')->with('sukses', 'Data barang berhasil ditambahkan!');
    }

    public function show(Barang $barang)
    {
        return view('inventaris.detailBarang', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('inventaris.ubahBarang', compact('barang'));
    }

    public function update(BarangRequest $request, Barang $barang)
    {
        $validated = $request->validated();
        
        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto', 'public');
        }
        
        if ($request->hasFile('file_manual')) {
            if ($barang->file_manual) {
                Storage::disk('public')->delete($barang->file_manual);
            }
            $validated['file_manual'] = $request->file('file_manual')->store('file', 'public');
        }
        
        $barang->update($validated);
        
        return redirect()->route('inventaris.index')->with('sukses', 'Data barang berhasil diubah!');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }
        if ($barang->file_manual) {
            Storage::disk('public')->delete($barang->file_manual);
        }
        
        $barang->delete();
        
        return redirect()->route('inventaris.index')->with('sukses', 'Data barang berhasil dihapus!');
    }
}
