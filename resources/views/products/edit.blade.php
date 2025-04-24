@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Edit Produk</h5>

            <!-- form edit produk, dikirim ke route update dengan ID produk -->
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- proteksi CSRF -->
                @method('PUT') <!-- karena method HTTP update itu PUT -->

                {{-- nama produk --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}"
                        placeholder="Contoh: Kaos Custom" required>
                </div>

                {{-- seskripsi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" name="description" class="form-control"
                        value="{{ old('description', $product->description) }}" id="description" rows="3"
                        placeholder="Tuliskan deskripsi produk..." required>
                </div>

                {{-- harga --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}"
                        id="price" placeholder="Contoh: 50000" required>
                </div>

                {{-- gambar Produk --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>

                    <div class="input-group">
                        <!-- input file disembunyikan, diganti dengan tombol custom -->
                        <input type="file" class="form-control d-none" name="image" id="image" accept="image/*"
                            onchange="previewFile()" />

                        <!-- tombol label untuk memilih gambar -->
                        <label for="image" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-upload"></i> Pilih Gambar
                        </label>

                        <!-- nama file akan muncul di sini -->
                        <span id="file-name" class="ms-3 text-muted">Belum ada file</span>
                    </div>

                    <!-- preview gambar produk -->
                    <div class="mt-3">
                        <img id="preview-image" src="{{ asset($product->image) }}" alt="Preview" width="150"
                            class="rounded shadow-sm border d-block" />
                    </div>
                </div>

                {{-- tombol Aksi --}}
                <div class="d-flex justify-content-between">
                    <!-- tombol kembali ke list produk -->
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <!-- tombol untuk update data produk -->
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>

            {{-- javaScript: Preview gambar sebelum submit --}}
            <script>
                // fungsi dipanggil pas ada perubahan file di input (onchange)
                function previewFile() {
                    const input = document.getElementById('image'); // ngambil element input file dari DOM yg punya id="image"
                    const fileName = document.getElementById(
                        'file-name'); // ngambil elemen <span> buat nampilin nama file yang dipilih sama user
                    const preview = document.getElementById(
                        'preview-image'); // ngambil elemen <img> buat nampilin preview gambar yang udah dipilih user

                    const file = input.files[0]; // ambil file pertama dari list file yang dipilih

                    // cek apakah ada file yang dipilih (biar gak error kalau kosong).
                    if (file) {
                        fileName.textContent = file.name; // tampilkan nama file yang dipilih ke dalam <span id="file-name">

                        // bikin object FileReader, untuk baca isi file yang dipilih (file gambar)    
                        const reader = new FileReader();

                        // ketika file selesai dibaca (onload), result dari FileReader (yang berupa Data URL) dipakai buat di-set ke src-nya <img>, jadi gambarnya langsung tampil
                        reader.onload = function(e) {
                            preview.src = e.target.result; // Tampilkan preview gambar
                        };
                        // nge-trigger proses membaca file sebagai Data URL (base64
                        reader.readAsDataURL(file);
                    }
                }
            </script>

        </div>
    </div>
@endsection
