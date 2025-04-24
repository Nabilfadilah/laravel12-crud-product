<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // menampilkan daftar produk milik user yang sedang login
    public function index()
    {
        // $products = Product::latest()->get();
        // mengambil produk berdasarkan user_id yang sedang login
        $products = Product::where('user_id', Auth::id())
            ->latest()
            ->get();

        // menampilkan view 'products.index' dengan data produk
        return view('products.index', compact('products'));
    }

    // menampilkan halaman form tambah product
    public function create()
    {
        return view('products.create');
    }

    // menyimpan produk baru dengan data gambar dalam format base64
    public function store(Request $request)
    {
        // validasi input dari form
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image_base64' => 'required|string',
        ]);

        // ambil data gambar dari input base64
        $base64Image = $request->image_base64;

        // cek apakah format data valid base64 image
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $data = substr($base64Image, strpos($base64Image, ',') + 1);
            $type = strtolower($type[1]); // jenis file: jpg, png, etc.

            // validasi jenis file
            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                return back()->withErrors(['image' => 'Unsupported image type']);
            }

            // decode base64 menjadi binary
            $data = base64_decode($data);
            if ($data === false) {
                return back()->withErrors(['image' => 'Base64 decode failed']);
            }

            // buat nama file unik dan simpan ke direktori 'uploads'
            $imageName = Str::uuid() . '.' . $type;
            $imagePath = public_path('uploads/' . $imageName);
            file_put_contents($imagePath, $data);
        } else {
            return back()->withErrors(['image' => 'Invalid image data']);
        }

        // simpan data product ke database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => 'uploads/' . $imageName,
            // 'user_id' => auth()->id(),
            'user_id' => Auth::id(), // ← menggunakan facade, mengaitkan produk dengan user yang login
            // 'user_id' => auth()->user()->id, // ← akses langsung dari objek
        ]);

        // redirect kehalam product jika semua berhasil
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    // menampilkan halaman edit product tertentu
    public function edit(Product $product)
    {
        // cegah user mengakses product milik orang lain 
        if ($product->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        return view('products.edit', compact('product'));
    }

    // menyimpan perubahan product yang sudah diedit 
    public function update(Request $request, Product $product)
    {
        // cegah user mengakses product milik orang lain 
        if ($product->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        // validasi input
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        // jika ada file gambar baru di-upload
        if ($request->hasFile('image')) {
            logger('image uploaded');
            $file = $request->file('image');
            logger($file);

            // buat nama file unik
            $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads');

            // Hapus gambar lama jika ada
            // Optional: delete image lama
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            try {
                // simpan file gambar baru
                $file->move($destinationPath, $imageName);
                logger("File moved to: uploads/{$imageName}");
                $validated['image'] = 'uploads/' . $imageName;
            } catch (\Exception $e) {
                logger("Move failed: " . $e->getMessage());
                return back()->withErrors(['image' => 'Gagal memindahkan file. ' . $e->getMessage()]);
            }
        }

        // dd($validated);

        // update data product di database
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // menghapus product tertentu
    public function destroy(Product $product)
    {
        // cegah user mengakses product milik orang lain 
        if ($product->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        // hapus file gambar dari storage jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // hapus data product dari database
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}

    // {
    //     $validated = $request->validate([
    //         'name' => 'required',
    //         'description' => 'nullable',
    //         'price' => 'required|numeric',
    //         'image' => 'nullable|image|max:2048'
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $validated['image'] = $request->file('image')->store('products', 'public');
    //     }

    //     dd($request->file('image'));

    //     Product::create($validated);
    //     return redirect()->route('products.index')->with('success', 'Product created successfully.');
    // }