<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'merk' => 'required|string|max:100',
            'nomor_seri' => 'required|string|max:100',
            'kondisi' => 'required|string|max:50',
            'lokasi' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'jam_input' => 'required',
            'jumlah' => 'required|integer|min:1',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'file_manual' => 'nullable|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['foto'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'image' => ':attribute harus berupa gambar.',
            'mimes' => ':attribute harus berformat: :values.',
            'max' => 'Ukuran :attribute terlalu besar.',
            'integer' => ':attribute harus berupa angka.',
            'min' => ':attribute minimal :min.'
        ];
    }
}
