<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::latest()->get();
        $products = Product::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    // dengan base64
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image_base64' => 'required|string',
        ]);

        $base64Image = $request->image_base64;

        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $data = substr($base64Image, strpos($base64Image, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, etc.

            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                return back()->withErrors(['image' => 'Unsupported image type']);
            }

            $data = base64_decode($data);
            if ($data === false) {
                return back()->withErrors(['image' => 'Base64 decode failed']);
            }

            $imageName = Str::uuid() . '.' . $type;
            $imagePath = public_path('uploads/' . $imageName);
            file_put_contents($imagePath, $data);
        } else {
            return back()->withErrors(['image' => 'Invalid image data']);
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => 'uploads/' . $imageName,
            // 'user_id' => auth()->id(),
            'user_id' => Auth::id(), // ← menggunakan facade
            // 'user_id' => auth()->user()->id, // ← akses langsung dari objek
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        // cegah user mengakses product milik orang lain 
        if ($product->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // cegah user mengakses product milik orang lain 
        if ($product->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            logger('image uploaded');
            $file = $request->file('image');
            logger($file);

            $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads');

            // Optional: delete image lama
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            try {
                $file->move($destinationPath, $imageName);
                logger("File moved to: uploads/{$imageName}");
                $validated['image'] = 'uploads/' . $imageName;
            } catch (\Exception $e) {
                logger("Move failed: " . $e->getMessage());
                return back()->withErrors(['image' => 'Gagal memindahkan file. ' . $e->getMessage()]);
            }
        }

        // dd($validated);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // cegah user mengakses product milik orang lain 
        if ($product->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
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