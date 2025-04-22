@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="Product Name" required>
        <input type="text" name="description" value="{{ old('description', $product->description) }}"
            placeholder="Deskripsi">
        <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="Price" required>

        <input type="file" name="image" accept="image/*" />

        @if ($product->image)
            <div>
                <p>Gambar saat ini:</p>
                <img src="{{ asset($product->image) }}" alt="Product Image" width="150">

                {{-- <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="150"> --}}
            </div>
        @endif

        <button type="submit">Update</button>
    </form>
@endsection
