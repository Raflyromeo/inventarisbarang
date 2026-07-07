<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'merk',
        'nomor_seri',
        'kondisi',
        'lokasi',
        'tanggal_masuk',
        'jam_input',
        'jumlah',
        'foto',
        'file_manual',
        'keterangan'
    ];
}
