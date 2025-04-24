@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Reset Password untuk <b>{{ $user->name }}</b></h5>

            <!-- form reset password, dikirim ke route user resetpassword dengan user_id -->
            <form action="{{ route('users.resetPassword', $user) }}" method="POST">
                @csrf <!-- proteksi CSRF -->

                {{-- password baru --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" required autofocus>
                </div>

                {{-- konfirmasi password baru --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required autofocus>
                </div>

                {{-- button --}}
                <div class="d-flex justify-content-center gap-3">
                    <!-- tombol kembali ke list user -->
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <!-- tombol untuk update password -->
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="bi bi-save"></i> Reset Password
                    </button>
                </div>
            </form>
        @endsection
