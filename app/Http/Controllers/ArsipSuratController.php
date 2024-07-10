<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArsipSuratRequest;
use App\Http\Requests\UpdateArsipSuratRequest;
use App\Models\ArsipSurat;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = ArsipSurat::with('kategoriSurat');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', '%' . $search . '%')
                    ->orWhere('judul_surat', 'like', '%' . $search . '%');
            });
        }

        $arsipSurat = $query->paginate(10);
        return view('arsip-surat.index', compact('arsipSurat'));
    }


    public function create()
    {
        $kategoriSurat = KategoriSurat::all();
        return view('arsip-surat.create', compact('kategoriSurat'));
    }

    public function store(StoreArsipSuratRequest $request)
    {
        $validated = $request->validated();
        $validated['file_surat'] = $request->file('file_surat')->store('arsip_surat', 'public');
        $validated['waktu_pengarsipan'] = now();

        ArsipSurat::create($validated);

        return redirect()->route('arsip-surat.index')
            ->with('success', 'Arsip surat berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $arsipSurat = ArsipSurat::findOrFail($id);
        $kategoriSurat = KategoriSurat::all();
        return view('arsip-surat.edit', compact('arsipSurat', 'kategoriSurat'));
    }

    public function update(UpdateArsipSuratRequest $request, $id)
    {
        $arsipSurat = ArsipSurat::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            // Hapus file lama jika ada
            if ($arsipSurat->file_surat && Storage::disk('public')->exists($arsipSurat->file_surat)) {
                Storage::disk('public')->delete($arsipSurat->file_surat);
            }
            // Simpan file baru
            $arsipSurat->file_surat = $request->file('file_surat')->store('arsip_surat', 'public');
        }

        $arsipSurat->save();

        return redirect()->route('arsip-surat.index')
            ->with('success', 'Arsip surat berhasil diperbarui.');
    }


    public function download($id)
    {
        $arsipSurat = ArsipSurat::findOrFail($id);
        $filePath = storage_path('app/public/' . $arsipSurat->file_surat);

        return response()->download($filePath);
    }



    public function destroy($id)
    {
        $arsipSurat = ArsipSurat::findOrFail($id);

        // Hapus file dari storage jika ada
        if ($arsipSurat->file_surat && Storage::disk('public')->exists($arsipSurat->file_surat)) {
            Storage::disk('public')->delete($arsipSurat->file_surat);
        }

        // Hapus entri dari database
        $arsipSurat->delete();

        return redirect()->route('arsip-surat.index')
            ->with('success', 'Arsip surat berhasil dihapus.');
    }
}