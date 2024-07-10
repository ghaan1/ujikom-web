@extends('layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="page-description text-center mb-4">
                    <h1 class="display-4">About</h1>
                    <span class="text-muted">Tentang Saya</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="card-title mb-0">Detail Data</h5>
                    </div>
                    <div class="card-body d-flex flex-column flex-md-row align-items-center p-4">
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <img src="./assets/images/foto.jpg" alt="Foto" class="img-fluid rounded-circle shadow">
                        </div>
                        <div class="col-md-8" style="margin-left:10px">
                            <ul class="list-unstyled">
                                <li><strong>Nama:</strong> Muhammad Ghaniyu Haq Haryanto</li>
                                <li><strong>Prodi:</strong> D4 Teknik Informatika</li>
                                <li><strong>NIM:</strong> 2041720178</li>
                                <li><strong>Tanggal:</strong> 10 Juli 2024</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>&copy; 2024 Muhammad Ghaniyu Haq Haryanto</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
