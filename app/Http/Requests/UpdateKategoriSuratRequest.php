<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKategoriSuratRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_kategori_surat' => [
                'required',
                Rule::unique('kategori_surat', 'nama_kategori_surat')->ignore($this->route('kategori_surat'))
            ],
            'keterangan_kategori_surat' => 'required',
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