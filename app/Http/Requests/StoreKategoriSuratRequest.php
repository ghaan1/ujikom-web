<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriSuratRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_kategori_surat' => 'required|unique:kategori_surat,nama_kategori_surat',
            'keterangan_kategori_surat' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nama_kategori_surat.required' => 'Nama kategori surat wajib diisi.',
            'nama_kategori_surat.unique' => 'Nama kategori surat sudah ada.',
            'keterangan_kategori_surat.required' => 'Keterangan kategori surat wajib diisi.',
        ];
    }
}