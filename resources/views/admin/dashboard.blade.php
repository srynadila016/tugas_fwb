@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
    <h1 class="mb-4">Dashboard Admin</h1>
    <p class="lead">Selamat datang, **{{ Auth::user()->name }}**! Ini adalah ringkasan operasional Anda.</p>

    <div class="row g-4 mt-3">
        <div class="col-lg-4 col-md-6">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-header"><i class="fas fa-boxes me-2"></i>Total Produk</div>
                <div class="card-body">

                    <p class="card-text">Produk yang tersedia saat ini.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-header"><i class="fas fa-hourglass-half me-2"></i>Transaksi Tertunda</div>
                <div class="card-body">
                    <p class="card-text">Transaksi yang menunggu tindakan.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-header"><i class="fas fa-money-bill-wave me-2"></i>Pendapatan Hari Ini</div>
                <div class="card-body">
                  
                    <p class="card-text">Total penjualan hari ini.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-5">
        <p>Gunakan menu navigasi untuk mengelola produk, transaksi, dan melihat laporan.</p>
    </div>
@endsection