@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Tambah Kategori Surat</h1>
                    <span>Tambahkan data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol "Simpan"</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form id="kategoriSuratForm" action="{{ route('kategori-surat.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="id_kategori_surat">ID Kategori Surat</label>
                                <input type="text" name="id_kategori_surat" class="form-control"
                                    value="{{ $lastId }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_kategori_surat">Nama Kategori Surat</label>
                                <input type="text" name="nama_kategori_surat"
                                    class="form-control @error('nama_kategori_surat') is-invalid @enderror"
                                    value="{{ old('nama_kategori_surat') }}" required>
                                @error('nama_kategori_surat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="keterangan_kategori_surat">Keterangan</label>
                                <textarea name="keterangan_kategori_surat" class="form-control @error('keterangan_kategori_surat') is-invalid @enderror"
                                    required>{{ old('keterangan_kategori_surat') }}</textarea>
                                @error('keterangan_kategori_surat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
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
                    document.getElementById('kategoriSuratForm').submit();
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
                    window.location.href = "{{ route('kategori-surat.index') }}";
                }
            });
        });
    </script>
@endsection
