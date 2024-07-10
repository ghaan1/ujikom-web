<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArsipSuratRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nomor_surat' => 'required|string|unique:arsip_surat,nomor_surat|max:255',
            'id_kategori_surat' => 'required|exists:kategori_surat,id',
            'judul_surat' => 'required|string|max:255',
            'file_surat' => 'required|file|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'nomor_surat.required' => 'Nomor surat wajib diisi',
            'nomor_surat.string' => 'Nomor surat harus berupa string',
            'nomor_surat.unique' => 'Nomor surat sudah ada',
            'nomor_surat.max' => 'Nomor surat maksimal 255 karakter',
            'id_kategori_surat.required' => 'Kategori surat wajib diisi',
            'id_kategori_surat.exists' => 'Kategori surat tidak ditemukan',
            'judul_surat.required' => 'Judul surat wajib diisi',
            'judul_surat.string' => 'Judul surat harus berupa string',
            'judul_surat.max' => 'Judul surat maksimal 255 karakter',
            'file_surat.required' => 'File surat wajib diisi',
            'file_surat.file' => 'File surat harus berupa file',
            'file_surat.mimes' => 'File surat harus berupa file pdf.',
        ];
    }
}