@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Edit Produk</h5>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- nama product --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}"
                        placeholder="Contoh: Kaos Custom" required>
                </div>

                {{-- deskripsi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" name="description" class="form-control"
                        value="{{ old('description', $product->description) }}" id="description" rows="3"
                        placeholder="Tuliskan deskripsi produk..." required></input>
                </div>

                {{-- price --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}"
                        id="price" placeholder="Contoh: 50000" required>
                </div>

                {{-- image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>

                    <div class="input-group">
                        <input type="file" class="form-control d-none" name="image" id="image" accept="image/*"
                            onchange="previewFile()" />
                        <label for="image" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-upload"></i> Pilih Gambar
                        </label>
                        <span id="file-name" class="ms-3 text-muted">Belum ada file</span>
                    </div>

                    <div class="mt-3">
                        <img id="preview-image" src="{{ asset($product->image) }}" alt="Preview" width="150"
                            class="rounded shadow-sm border d-block" />
                    </div>
                </div>

                {{-- button --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>

            {{-- Script Preview Gambar & Nama File --}}
            <script>
                function previewFile() {
                    const input = document.getElementById('image');
                    const fileName = document.getElementById('file-name');
                    const preview = document.getElementById('preview-image');

                    const file = input.files[0];

                    if (file) {
                        fileName.textContent = file.name;

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            </script>

        </div>
    </div>
@endsection
