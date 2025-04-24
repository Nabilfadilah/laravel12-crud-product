@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">User List</h2>
    </div>

    {{-- alert ketika success add product --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 20px">No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 250px" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- menampilkan daftar user dalam table --}}
                    @foreach ($users as $user)
                        <tr>
                            {{-- no data --}}
                            <td class="text-center">{{ $loop->iteration }}.</td>

                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>

                            {{-- button aksi --}}
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                    @csrf <!-- proteksi CSRF -->
                                    @method('DELETE') <!-- karena method HTTP delete itu DELETE -->

                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus user ini?')">Delete</button>
                                </form>
                                <a href="{{ route('users.resetPasswordForm', $user) }}" class="btn btn-sm btn-primary">Reset
                                    Password</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
