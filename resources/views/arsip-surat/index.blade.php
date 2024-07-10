@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Arsip Surat</h1>
                    <span>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.</span>
                    <span>Klik "Lihat" pada kolom aksi untuk menampilkan surat.</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="card-title" style="font-size:20px">Tabel Arsip Surat</h1>
                            <div class="d-flex">
                                <form action="{{ route('arsip-surat.index') }}" method="GET" class="d-flex mr-2">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari Arsip Surat" value="{{ request('search') }}">
                                        <button class="btn btn-secondary" style="margin-right: 10px"
                                            type="submit">Cari</button>
                                    </div>
                                </form>
                                <a href="{{ route('arsip-surat.create') }}" class="btn btn-primary btn-lg">
                                    Arsipkan Surat</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomor Surat</th>
                                    <th>Kategori</th>
                                    <th>Judul Surat</th>
                                    <th>Waktu Pengarsipan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arsipSurat as $index => $listArsipSurat)
                                    <tr>
                                        <td>{{ $arsipSurat->firstItem() + $index }}</td>
                                        <td>{{ $listArsipSurat->nomor_surat }}</td>
                                        <td>{{ $listArsipSurat->kategoriSurat->nama_kategori_surat }}</td>
                                        <td>{{ $listArsipSurat->judul_surat }}</td>
                                        <td>{{ $listArsipSurat->waktu_pengarsipan }}</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="{{ route('arsip-surat.download', $listArsipSurat->id) }}"
                                                    class="btn btn-primary mr-2" style="margin-left: 10px">Unduh</a>
                                                <a href="{{ route('arsip-surat.edit', $listArsipSurat->id) }}"
                                                    class="btn btn-warning">Lihat</a>
                                                <form action="{{ route('arsip-surat.destroy', $listArsipSurat->id) }}"
                                                    method="POST" style="display: inline" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                @if ($arsipSurat->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $arsipSurat->previousPageUrl() }}">Previous</a>
                                    </li>
                                @endif

                                @foreach ($arsipSurat->getUrlRange(1, $arsipSurat->lastPage()) as $page => $url)
                                    @if ($page == $arsipSurat->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($arsipSurat->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $arsipSurat->nextPageUrl() }}">Next</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Next</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.alert')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Apakah Anda yakin ingin menghapus arsip surat ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
