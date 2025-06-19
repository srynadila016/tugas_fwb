<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="">E-commerce App</a> -->
             <h1>penjualan</h1>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        @if(Auth::user()->isOwner())
                            <li class="nav-item"><a class="nav-link" href="{{ route('owner.dashboard') }}">Owner Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('owner.products.index') }}">Kelola Produk</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('owner.admins.index') }}">Kelola Admin</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('owner.buyers.index') }}">Kelola Pembeli</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('owner.reports.sales') }}">Laporan Penjualan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('owner.reports.transactions') }}">Laporan Transaksi</a></li>
                        @elseif(Auth::user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}">Kelola Produk</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.buyers.index') }}">Daftar Pembeli</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.sales.create') }}">Input Penjualan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports.sales') }}">Laporan Penjualan</a></li>
                        @elseif(Auth::user()->isPembeli())
                            <li class="nav-item"><a class="nav-link" href="{{ route('buyer.dashboard') }}">Pembeli Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('buyer.products.index') }}">Lihat Produk</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('buyer.cart.index') }}">Keranjang</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('buyer.transactions.index') }}">Riwayat Transaksi</a></li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }} ({{ Auth::user()->role }})
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-link nav-link text-decoration-none text-dark p-0">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>