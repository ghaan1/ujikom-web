<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArsipSuratRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file_surat' => 'nullable|file|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'file_surat.file' => 'File surat harus berupa file',
            'file_surat.mimes' => 'File surat harus berupa file pdf.',
        ];
    }
}