@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Reset Password untuk <b>{{ $user->name }}</b></h5>

            <form action="{{ route('users.resetPassword', $user) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" required autofocus>
                </div>


                <div class="mb-3">
                    <label for="name" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required autofocus>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="bi bi-save"></i> Reset Password
                    </button>
                </div>
            </form>
        @endsection
