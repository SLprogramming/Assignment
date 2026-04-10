<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categories')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $productData = $request->only(['name', 'price', 'stock_qty']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('products', 'public');
            $productData['photo'] = "storage/" . $path;
        }

        $product = Product::create($productData);

        if ($request->categories) {
            $product->categories()->attach($request->categories);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $productData = $request->only(['name', 'price', 'stock_qty']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('products', 'public');
            $productData['photo'] = "storage/" . $path;
        }

        $product->update($productData);

        if ($request->categories) {
            $product->categories()->sync($request->categories);
        } else {
            $product->categories()->detach();
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Optional: Delete photo from storage if exists
        if ($product->photo && file_exists(public_path($product->photo))) {
            unlink(public_path($product->photo));
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted permanently!');
    }
}
