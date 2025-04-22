@extends('layouts.app')

@section('content')
    <h1>Create Product</h1>
    {{-- <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input name="price" class="form-control" type="number" step="0.01" value="{{ old('price') }}">
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input name="image" type="file" class="form-control">
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form> --}}

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="description" placeholder="Deskripsi" required>
        <input type="number" name="price" placeholder="Price" required>

        <input type="file" id="imageInput" accept="image/*" required />
        <input type="hidden" name="image_base64" id="imageBase64" />

        <button type="submit">Save</button>
    </form>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onloadend = function() {
                document.getElementById('imageBase64').value = reader.result;
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
