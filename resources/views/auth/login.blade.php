@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0">Selamat Datang!</h4>
                <p class="mb-0">Silakan masuk untuk melanjutkan</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Alamat Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukkan password Anda">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat Saya</label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-sign-in-alt me-2"></i>Login</button>
                    </div>
                </form>
                

                <hr class="my-4">
                <p class="text-center mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</div>
@endsection