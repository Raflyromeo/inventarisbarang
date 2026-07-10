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
        // Statistik hanya dari data aktif (tidak termasuk yang di-soft delete)
        $totalBarang = Barang::count();
        $barangBaik = Barang::where('kondisi', 'Baik')->count();
        $barangDipinjam = Barang::where('kondisi', 'Dipinjam')->count();
        $barangRusak = Barang::where('kondisi', 'Rusak')->count();
        $barangDihapus = Barang::onlyTrashed()->count();

        $barangTerbaru = Barang::latest()->take(5)->get();

        return view('dashboard', compact('totalBarang', 'barangBaik', 'barangDipinjam', 'barangRusak', 'barangDihapus', 'barangTerbaru'));
    }

    public function index(Request $request)
    {
        $query = Barang::query();

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->cari . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->cari . '%')
                  ->orWhere('merk', 'like', '%' . $request->cari . '%')
                  ->orWhere('nomor_seri', 'like', '%' . $request->cari . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        $perPage = $request->get('per_page', 10);
        $barang = $query->latest()->paginate($perPage)->withQueryString();

        return view('inventaris.daftarBarang', compact('barang'));
    }

    /**
     * Autocomplete untuk pencarian barang
     */
    public function autocomplete(Request $request)
    {
        $term = $request->get('term', '');
        $results = Barang::where('nama_barang', 'like', '%' . $term . '%')
            ->orWhere('kode_barang', 'like', '%' . $term . '%')
            ->select('id', 'nama_barang', 'kode_barang', 'kategori')
            ->limit(10)
            ->get();

        return response()->json($results);
    }

    public function create()
    {
        return view('inventaris.tambahBarang');
    }

    public function store(BarangRequest $request)
    {
        $validated = $request->validated();

        // Generate Kode Barang (IT-0001)
        $lastBarang = Barang::withTrashed()->orderBy('id', 'desc')->first();
        $nextId = $lastBarang ? $lastBarang->id + 1 : 1;
        $validated['kode_barang'] = 'IT-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        // Simpan foto ke storage PRIVATE (bukan public)
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto', 'local');
        }

        // Simpan file manual ke storage PRIVATE (bukan public)
        if ($request->hasFile('file_manual')) {
            $validated['file_manual'] = $request->file('file_manual')->store('file_manual', 'local');
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
            // Hapus foto lama dari storage private
            if ($barang->foto) {
                Storage::disk('local')->delete($barang->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto', 'local');
        }

        if ($request->hasFile('file_manual')) {
            // Hapus file manual lama dari storage private
            if ($barang->file_manual) {
                Storage::disk('local')->delete($barang->file_manual);
            }
            $validated['file_manual'] = $request->file('file_manual')->store('file_manual', 'local');
        }

        $barang->update($validated);

        return redirect()->route('inventaris.index')->with('sukses', 'Data barang berhasil diubah!');
    }

    /**
     * Soft Delete - Data tidak dihapus permanen dari database
     */
    public function destroy(Barang $barang)
    {
        $barang->delete(); // Ini soft delete (hanya set deleted_at)

        return redirect()->route('inventaris.index')->with('sukses', 'Data barang berhasil dipindahkan ke tong sampah!');
    }

    /**
     * Halaman Tong Sampah (Trash) - menampilkan data yang di-soft delete
     */
    public function trash()
    {
        $barangDihapus = Barang::onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('inventaris.trash', compact('barangDihapus'));
    }

    /**
     * Restore data dari tong sampah
     */
    public function restore($id)
    {
        $barang = Barang::onlyTrashed()->findOrFail($id);
        $barang->restore();

        return redirect()->route('inventaris.trash')->with('sukses', 'Data barang berhasil dipulihkan!');
    }

    /**
     * Hapus permanen dari database
     */
    public function forceDelete($id)
    {
        $barang = Barang::onlyTrashed()->findOrFail($id);

        // Hapus file fisik dari storage private
        if ($barang->foto) {
            Storage::disk('local')->delete($barang->foto);
        }
        if ($barang->file_manual) {
            Storage::disk('local')->delete($barang->file_manual);
        }

        $barang->forceDelete();

        return redirect()->route('inventaris.trash')->with('sukses', 'Data barang berhasil dihapus permanen!');
    }

    /**
     * Serve file foto secara aman (tidak bisa diakses langsung via URL publik)
     */
    public function serveFoto(Barang $barang)
    {
        if (!$barang->foto || !Storage::disk('local')->exists($barang->foto)) {
            abort(404);
        }

        $path = Storage::disk('local')->path($barang->foto);
        $mimeType = mime_content_type($path);

        return response()->file($path, ['Content-Type' => $mimeType]);
    }

    /**
     * Serve file manual (PDF) secara aman
     */
    public function serveFileManual(Barang $barang)
    {
        if (!$barang->file_manual || !Storage::disk('local')->exists($barang->file_manual)) {
            abort(404);
        }

        $path = Storage::disk('local')->path($barang->file_manual);

        return response()->file($path, ['Content-Type' => 'application/pdf']);
    }
}
