@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Edit Produk</h5>

            <!-- form edit user, dikirim ke route update dengan user id -->
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf <!-- proteksi CSRF -->
                @method('PUT') <!-- karena method HTTP update itu PUT -->

                {{-- name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama User</label>
                    <input name="name" class="form-control" value="{{ $user->name }}">
                </div>

                {{-- email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email User</label>
                    <input name="email" class="form-control" value="{{ $user->email }}">
                </div>

                {{-- opsi role --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Role User</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                {{-- button --}}
                <div class="d-flex justify-content-center gap-3">
                    <!-- tombol kembali ke list user -->
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <!-- tombol untuk update data user -->
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
