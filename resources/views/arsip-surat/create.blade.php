@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Tambah Arsip Surat</h1>
                    <span>Unggah surat yang telah terbit pada form ini untuk diarsipkan.</span>
                    <span>Catatan:</span>
                    <ul>
                        <li>Gunakan file berformat PDF</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form id="arsipSuratForm" action="{{ route('arsip-surat.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nomor_surat">Nomor Surat</label>
                                <input type="text" name="nomor_surat"
                                    class="form-control @error('nomor_surat') is-invalid @enderror"
                                    value="{{ old('nomor_surat') }}">
                                @error('nomor_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_kategori_surat">Kategori Surat</label>
                                <select name="id_kategori_surat"
                                    class="form-control select2 @error('id_kategori_surat') is-invalid @enderror">
                                    <option value="">Pilih Kategori Surat</option>
                                    @foreach ($kategoriSurat as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori_surat }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="judul_surat">Judul Surat</label>
                                <input type="text" name="judul_surat"
                                    class="form-control @error('judul_surat') is-invalid @enderror"
                                    value="{{ old('judul_surat') }}">
                                @error('judul_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="file_surat">File Surat</label>
                                <input type="file" name="file_surat" accept="application/pdf"
                                    class="form-control @error('file_surat') is-invalid @enderror">
                                @error('file_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" id="cancelBtn" class="btn btn-secondary"
                                    style="margin-right: 10px">Kembali</button>
                                <button type="button" id="submitBtn" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menyimpan data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('arsipSuratForm').submit();
                }
            });
        });

        document.getElementById('cancelBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin membatalkan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batal!',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('arsip-surat.index') }}";
                }
            });
        });
    </script>
@endsection
