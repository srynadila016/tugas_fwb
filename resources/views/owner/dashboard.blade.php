@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 mb-0">Dashboard Owner</h1>
        <p class="lead mb-0 text-muted">Selamat datang kembali, **{{ Auth::user()->name }}**!</p>
    </div>
   
    

    <div class="row g-4 mb-5">
        {{-- Total Produk --}}
        <div class="col-lg-4 col-md-6">
            <div class="card bg-primary text-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-boxes fa-3x me-4"></i>
                        <div>
                            <h5 class="card-title text-uppercase mb-0">Total Produk</h5>
                          
                            <small>Produk terdaftar di sistem</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light-primary border-0">
                    <a href="{{ route('owner.products.index') }}" class="text-white text-decoration-none d-flex justify-content-between align-items-center">
                        Lihat Detail Produk
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Total Admin --}}
        <div class="col-lg-4 col-md-6">
            <div class="card bg-info text-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-shield fa-3x me-4"></i>
                        <div>
                            <h5 class="card-title text-uppercase mb-0">Total Admin</h5>
                 
                            <small>Akun admin terdaftar</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light-info border-0">
                    <a href="{{ route('owner.admins.index') }}" class="text-white text-decoration-none d-flex justify-content-between align-items-center">
                        Kelola Admin
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Total Pembeli --}}
        <div class="col-lg-4 col-md-6">
            <div class="card bg-success text-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-3x me-4"></i>
                        <div>
                            <h5 class="card-title text-uppercase mb-0">Total Pembeli</h5>
                            <small>Akun pembeli terdaftar</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light-success border-0">
                    <a href="{{ route('owner.buyers.index') }}" class="text-white text-decoration-none d-flex justify-content-between align-items-center">
                        Kelola Pembeli
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    

    <div class="row g-4">
        {{-- Bagian Laporan --}}
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-dark text-white d-flex align-items-center">
                    <i class="fas fa-chart-line me-2"></i>Laporan & Analisis
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <a href="{{ route('owner.reports.sales') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Laporan Penjualan Harian
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="{{ route('owner.reports.transactions') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Detail Semua Transaksi
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        {{-- Tambahkan link laporan lain jika ada --}}
                    </ul>
                </div>
            </div>
        </div>

        {{-- Tugas Cepat / Akses Cepat --}}
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white d-flex align-items-center">
                    <i class="fas fa-bolt me-2"></i>Akses Cepat
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <a href="{{ route('owner.products.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Kelola Produk
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('owner.admins.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Kelola Data Admin
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('owner.buyers.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Kelola Data Pembeli
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </ul>
                    <div class="text-center mt-4">
                        <p class="text-muted mb-2">Perlu bantuan?</p>
                        <a href="#" class="btn btn-outline-secondary"><i class="fas fa-info-circle me-2"></i>Panduan Penggunaan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection