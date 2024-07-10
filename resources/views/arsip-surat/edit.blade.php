@extends('layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="page-description text-center mb-4">
                    <h1>Arsip Surat >> Lihat</h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>Detail Arsip Surat</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Nomor:</strong> {{ $arsipSurat->nomor_surat }}</p>
                        <p><strong>Kategori:</strong> {{ $arsipSurat->kategoriSurat->nama_kategori_surat }}</p>
                        <p><strong>Judul:</strong> {{ $arsipSurat->judul_surat }}</p>
                        <p><strong>Waktu Unggah:</strong> {{ $arsipSurat->created_at }}</p>
                        <div class="pdf-container my-4">
                            <iframe id="pdfViewer" src="{{ Storage::url($arsipSurat->file_surat) }}" width="100%"
                                height="600px" style="border: none;"></iframe>
                        </div>
                        <div id="uploadFormContainer" class="mb-3" style="display: none;">
                            <form id="arsipSuratForm" action="{{ route('arsip-surat.update', $arsipSurat->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="file_surat">Ganti File Surat</label>
                                    <input type="file" name="file_surat" accept="application/pdf"
                                        class="form-control @error('file_surat') is-invalid @enderror">
                                    @error('file_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Upload</button>
                            </form>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('arsip-surat.index') }}" class="btn btn-secondary mr-2">
                                << Kembali</a>
                                    <a href="{{ route('arsip-surat.download', $arsipSurat->id) }}"
                                        class="btn btn-primary mr-2" style="margin-left: 10px">Unduh</a>
                                    <button type="button" id="editFileBtn" class="btn btn-warning"
                                        style="margin-left: 10px">Edit/Ganti File</button>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>&copy; 2024 Arsip Surat</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('editFileBtn').addEventListener('click', function() {
            var uploadFormContainer = document.getElementById('uploadFormContainer');
            if (uploadFormContainer.style.display === 'none') {
                uploadFormContainer.style.display = 'block';
            } else {
                uploadFormContainer.style.display = 'none';
            }
        });

        document.getElementById('arsipSuratForm').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin memperbarui file ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });
    </script>
@endsection
