<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //make kategori surat with 20 data dont use factory
        for ($i = 1; $i <= 20; $i++) {
            DB::table('kategori_surat')->insert([
                'nama_kategori_surat' => 'Kategori Surat ' . $i,
                'keterangan_kategori_surat' => 'Keterangan Kategori Surat ' . $i,
            ]);
        }
    }
}