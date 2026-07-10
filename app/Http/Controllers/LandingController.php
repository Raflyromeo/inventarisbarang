<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $barangBaik = Barang::where('kondisi', 'Baik')->count();
        $barangDipinjam = Barang::where('kondisi', 'Dipinjam')->count();
        $barangRusak = Barang::where('kondisi', 'Rusak')->count();
        $kategoriList = Barang::select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->values();

        return view('landing', compact('totalBarang', 'barangBaik', 'barangDipinjam', 'barangRusak', 'kategoriList'));
    }
}
