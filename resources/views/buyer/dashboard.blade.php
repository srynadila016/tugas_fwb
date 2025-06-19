@extends('layouts.app')
@section('title', 'Dashboard Pembeli')
@section('content')
    <h1 class="mb-4">Dashboard Pembeli</h1>
    <p class="lead">Selamat datang kembali, **{{ Auth::user()->name }}**! Apa yang ingin Anda lakukan hari ini?</p>

    <div class="row g-4 mt-3">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white"><i class="fas fa-clock-rotate-left me-2"></i>Transaksi Terbaru Anda</div>
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white"><i class="fas fa-link me-2"></i>Akses Cepat</div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('buyer.products.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-search me-2"></i>Jelajahi Produk</a>
                        <a href="{{ route('buyer.cart.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-shopping-basket me-2"></i>Lihat Keranjang Saya</a>
                        <a href="{{ route('buyer.transactions.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-clipboard-list me-2"></i>Riwayat Pembelian</a>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('buyer.products.index') }}" class="btn btn-success btn-lg"><i class="fas fa-shopping-bag me-2"></i>Mulai Belanja</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection