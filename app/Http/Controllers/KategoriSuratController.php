<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriSuratRequest;
use App\Http\Requests\UpdateKategoriSuratRequest;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class KategoriSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $kategoriSurat = KategoriSurat::when($search, function ($query, $search) {
            return $query->where('nama_kategori_surat', 'like', "%{$search}%")
                ->orWhere('keterangan_kategori_surat', 'like', "%{$search}%");
        })->paginate(10);

        return view('kategori-surat.index', compact('kategoriSurat'));
    }


    public function create()
    {
        $lastId = KategoriSurat::max('id') + 1;
        return view('kategori-surat.create', compact('lastId'));
    }


    public function store(StoreKategoriSuratRequest $request)
    {
        KategoriSurat::create($request->all());

        return redirect()->route('kategori-surat.index')
            ->with('success', 'Kategori surat berhasil dibuat.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kategoriSurat = KategoriSurat::findOrFail($id);
        return view('kategori-surat.edit', compact('kategoriSurat'));
    }

    public function update(UpdateKategoriSuratRequest $request, $id)
    {
        $kategoriSurat = KategoriSurat::findOrFail($id);
        $kategoriSurat->update($request->all());

        return redirect()->route('kategori-surat.index')
            ->with('success', 'Kategori surat berhasil diupdate.');
    }

    public function destroy($id)
    {
        try {
            $kategoriSurat = KategoriSurat::findOrFail($id);
            $kategoriSurat->delete();

            return redirect()->route('kategori-surat.index')
                ->with('success', 'Kategori surat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kategori-surat.index')
                ->with('error', 'Kategori surat tidak dapat dihapus karena ada data yang terkait.');
        }
    }
}