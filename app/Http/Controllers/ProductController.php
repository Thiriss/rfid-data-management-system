<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Rfid;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'size' => 'nullable|string',
            'category' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    // Show edit form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
       
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'size' => 'nullable|string',
            'category' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

       if ($request->hasFile('image')) {
            // Delete the old image
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }


        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // Delete product
    public function destroy(Product $product)
    {
        // Optional: delete image file
        if ($product->image && Storage::exists('public/uploads/' . $product->image)) {
            Storage::delete('public/uploads/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function show(Product $product)
    {
        //$product->load('rfids'); //or
        //$rfids =  Rfid::where('product_id',$product->id)->get();
        $product->load(['rfids.latestLocation']);

        return view('products.show', compact('product'));
    }

}
