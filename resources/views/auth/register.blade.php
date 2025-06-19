@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white text-center py-3">
                <h4 class="mb-0">Daftar Akun Baru</h4>
                <p class="mb-0">Bergabunglah dengan kami sekarang!</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Nama Anda">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Alamat Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"  placeholder="email@contoh.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  placeholder="Minimal 8 karakter">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label"><i class="fas fa-lock me-2"></i>Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  placeholder="Ketik ulang password Anda">
                    </div>
                    
                    {{-- Tambahkan pilihan role di sini --}}
                    <div class="mb-3">
                        <label for="role" class="form-label"><i class="fas fa-user-tag me-2"></i>Daftar Sebagai</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="">Pilih Peran</option>
                            <option value="pembeli" {{ old('role') == 'pembeli' ? 'selected' : '' }}>Pembeli</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-user-plus me-2"></i>Daftar Sekarang</button>
                    </div>
                </form>
                <hr class="my-4">
                <p class="text-center mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a></p>
            </div>
        </div>
    </div>
</div>
@endsection