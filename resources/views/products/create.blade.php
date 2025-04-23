@extends('layouts.app')

@section('content')
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


    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Tambah Produk Baru</h5>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- name product --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" id="name"
                        placeholder="Contoh: Kaos Custom" required autofocus>
                </div>

                {{-- deskripsi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" name="description" class="form-control" id="description" rows="3"
                        placeholder="Tuliskan deskripsi produk..." required autofocus></input>
                </div>

                {{-- price --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="Contoh: 50000"
                        required autofocus>
                </div>

                {{-- image 1 --}}
                <div class="mb-3">
                    <label for="imageInput" class="form-label">Gambar Produk</label>
                    <input type="file" class="form-control" id="imageInput" accept="image/*" required>
                    <input type="hidden" name="image_base64" id="imageBase64">
                </div>

                {{-- image --}}
                {{-- <div class="mb-3">
                    <label for="imageInput" class="form-label">Gambar Produk 2</label>
                    <input type="file" class="form-control" id="imageInput" accept="image/*" required>
                    <input type="hidden" name="image_base64" id="imageBase64">
                    <div class="mt-3">
                        <img id="preview-image" src="#" alt="Preview" width="150"
                            class="rounded shadow-sm border d-none" />
                    </div>
                </div> --}}

                {{-- image --}}
                {{-- <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk 3</label>
                    <div class="input-group">
                        <input type="file" class="form-control d-none" name="image" id="image" accept="image/*"
                            onchange="previewFile()" required>
                        <label for="image" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-upload"></i> Pilih Gambar
                        </label>
                        <span id="file-name" class="ms-3 text-muted">Belum ada file</span>
                    </div>

                    <div class="mt-3">
                        <img id="preview-image" src="#" alt="Preview" width="150"
                            class="rounded shadow-sm border d-none" />
                    </div>
                </div> --}}

                {{-- button --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="bi bi-save"></i> Simpan Produk
                    </button>
                </div>
            </form>

            <script>
                // Script konversi gambar ke Base64
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

                // konvert image
                // document.getElementById('imageInput').addEventListener('change', function(e) {
                //     const file = e.target.files[0];
                //     const reader = new FileReader();
                //     reader.onloadend = function() {
                //         document.getElementById('imageBase64').value = reader.result;

                //         // Tampilkan preview
                //         const preview = document.getElementById('preview-image');
                //         preview.src = reader.result;
                //         preview.classList.remove('d-none');
                //     };
                //     if (file) {
                //         reader.readAsDataURL(file);
                //     }
                // });

                // Script Preview Gambar & Nama File
                // function previewFile() {
                //     const input = document.getElementById('image');
                //     const fileName = document.getElementById('file-name');
                //     const preview = document.getElementById('preview-image');
                //     const file = input.files[0];

                //     if (file) {
                //         fileName.textContent = file.name;

                //         const reader = new FileReader();
                //         reader.onload = function(e) {
                //             preview.src = e.target.result;
                //             preview.classList.remove('d-none');
                //         };
                //         reader.readAsDataURL(file);
                //     }
                // }
            </script>
        </div>
    </div>
@endsection
