<?php

namespace App\Http\Controllers;

use App\Models\Rfid;
use App\Models\Product;
use Illuminate\Http\Request;

class RfidController extends Controller
{
    // Show all RFID tags
    public function index()
    {
        $rfids = Rfid::with('product')->orderBy('created_at', 'desc')->paginate(10);
        return view('rfids.index', compact('rfids'));
    }

    // Show create form
    public function create()
    {
          $products = Product::withCount(['rfids as assigned_count'])
                    ->get()
                    ->filter(function ($product) {
                        return $product->quantity > $product->assigned_count;
                    })
                    ->values();
        return view('rfids.create', compact('products'));
    }

    // Store new RFID tag
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tag_id' => 'required|string|max:255|unique:rfids,tag_id',
            'product_id' => 'nullable|exists:products,id',
            'status' => 'required|in:active,inactive',
        ]);

        Rfid::create($validated);

        return redirect()->route('rfids.index')->with('success', 'RFID tag created successfully');
    }


    // Show edit form
    public function edit(Rfid $rfid)
    {
        $currentProductId = $rfid->product_id;
        $products = Product::withCount(['rfids as assigned_count'])
                    ->get()
                    ->filter(function ($product) use ($currentProductId) {
                    // Keep products that are not fully assigned OR the one currently assigned
                        return $product->quantity > $product->assigned_count || $product->id === $currentProductId;
                    })
                    ->values();

        return view('rfids.edit', compact('rfid', 'products'));
    }

    // Update RFID tag
    public function update(Request $request, Rfid $rfid)
    {
        $validated = $request->validate([
            'tag_id' => 'required|string|max:255|unique:rfids,tag_id,' . $rfid->id,
            'product_id' => 'nullable|exists:products,id',
            'status' => 'required|in:active,inactive',
        ]);

        $rfid->update($validated);

        $redirectTo = $request->input('redirect_to') ?? route('rfids.index'); 

        return redirect($redirectTo)->with('success', 'RFID tag updated successfully!');

    }

    // Delete RFID tag
    public function destroy(Rfid $rfid)
    {
        $rfid->delete();
        return redirect()->route('rfids.index')->with('success', 'RFID tag deleted successfully');
    }
}
