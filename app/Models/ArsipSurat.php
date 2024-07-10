<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;

    protected $table = 'arsip_surat';

    protected $fillable = [
        'nomor_surat',
        'id_kategori_surat',
        'judul_surat',
        'file_surat',
        'waktu_pengarsipan',
    ];

    public function kategoriSurat()
    {
        return $this->belongsTo(KategoriSurat::class, 'id_kategori_surat');
    }
}