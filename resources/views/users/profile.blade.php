{{-- menggunakan layout utama dari layouts/app.blade.php --}}
@extends('layouts.app')

{{-- mulai bagian konten yang akan dimasukkan ke dalam layout --}}
@section('content')
    <div class="container my-5"> {{-- container dengan margin atas & bawah --}}
        <div class="row justify-content-center"> {{-- row Bootstrap dengan konten di tengah --}}
            <div class="col-md-8"> {{-- kolom lebar 8 dari 12 --}}
                <div class="card shadow-sm border-0"> {{-- card Bootstrap tanpa border dan dengan shadow ringan --}}

                    {{-- header card dengan background biru dan teks putih --}}
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-person-circle me-2"></i> {{-- icon user dari Bootstrap Icons --}}
                            Profil Pengguna
                        </h5>
                    </div>

                    {{-- body dari card --}}
                    <div class="card-body">

                        {{-- tampilkan Nama --}}
                        <div class="mb-3">
                            <label class="form-label text-muted">Nama</label>
                            <p class="form-control-plaintext">{{ $user->name }}</p> {{-- menampilkan nama user --}}
                        </div>

                        {{-- tampilkan Email --}}
                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <p class="form-control-plaintext">{{ $user->email }}</p> {{-- menampilkan email user --}}
                        </div>

                        {{-- tampilkan Role --}}
                        <div class="mb-3">
                            <label class="form-label text-muted">Role</label>
                            {{-- badge dengan warna berdasarkan role user --}}
                            <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'secondary' }}">
                                {{ ucfirst($user->role) }} {{-- kapitalisasi huruf pertama --}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
