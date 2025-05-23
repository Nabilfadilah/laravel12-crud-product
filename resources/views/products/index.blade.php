@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Product List</h4>
        {{-- route ke page create product --}}
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">+ Add Product</a>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Deskripsi</th>
                        <th>Price</th>
                        <th style="width: 130px" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- menampilkan daftar product dalam table --}}
                    @foreach ($products as $product)
                        <tr>
                            {{-- no data --}}
                            <td class="text-center">{{ $loop->iteration }}.</td>

                            {{-- image --}}
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" alt="Product Image" width="100">
                                @endif
                            </td>

                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                            {{-- button aksi --}}
                            <td class="text-center">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf <!-- proteksi CSRF -->
                                    @method('DELETE') <!-- karena method HTTP delete itu DELETE -->

                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus produk ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
