@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Kategori Surat</h1>
                    <span>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat.</span>
                    <span>Klik "Tambah" pada kolom aksi untuk menambahkan kategori baru.</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="card-title" style="font-size:20px">Tabel Kategori Surat</h1>
                            <div class="d-flex">
                                <form action="{{ route('kategori-surat.index') }}" method="GET" class="d-flex mr-2">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari Kategori Surat" value="{{ request('search') }}">
                                        <button class="btn btn-secondary" style="margin-right: 10px"
                                            type="submit">Cari</button>
                                    </div>
                                </form>
                                <a href="{{ route('kategori-surat.create') }}" class="btn btn-primary btn-lg">Tambah
                                    Kategori</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="example-container">
                            <div class="example-content">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Kategori Surat</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategoriSurat as $index => $listKategoriSurat)
                                            <tr>
                                                <th scope="row">{{ $kategoriSurat->firstItem() + $index }}</th>
                                                <td>{{ $listKategoriSurat->nama_kategori_surat }}</td>
                                                <td>{{ $listKategoriSurat->keterangan_kategori_surat }}</td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="{{ route('kategori-surat.edit', $listKategoriSurat->id) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <form
                                                            action="{{ route('kategori-surat.destroy', $listKategoriSurat->id) }}"
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
                                        @if ($kategoriSurat->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">Previous</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $kategoriSurat->previousPageUrl() }}">Previous</a>
                                            </li>
                                        @endif

                                        @foreach ($kategoriSurat->getUrlRange(1, $kategoriSurat->lastPage()) as $page => $url)
                                            @if ($page == $kategoriSurat->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        @if ($kategoriSurat->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $kategoriSurat->nextPageUrl() }}">Next</a>
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
        </div>
    </div>
    @include('components.alert')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Apakah Anda yakin ingin menghapus kategori surat ini?",
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
