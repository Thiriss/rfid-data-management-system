<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RfidLocation;
use App\Models\Rfid;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $rfidData = RfidLocation::where('status', 'active')
    //                 ->orderBy('id', 'asc')
    //                 // ->latest()->take(20)
    //                 ->get();

    //     return view('dashboard', compact('rfidData'));
    // }

    public function index()
{
    $rfidData = DB::table('rfid_locations')
        ->join('rfids', 'rfid_locations.tag_id', '=', 'rfids.tag_id')
        ->leftJoin('products', 'rfids.product_id', '=', 'products.id')
        ->where('rfid_locations.status', 'active')
        ->orderBy('rfid_locations.id', 'asc')
        ->select('rfid_locations.*', 'products.name as product_name')
        ->get();

    return view('dashboard', compact('rfidData'));
}

     public function showByTagId($tag_id)
    {

           $rfid = Rfid::select('rfids.tag_id','rfid_locations.location',
            'rfid_locations.status','products.name','products.price','products.size',
            'products.category','products.type')
            ->leftJoin('rfid_locations', 'rfid_locations.tag_id', 'rfids.tag_id')
            ->leftJoin('products', 'products.id', 'rfids.product_id')
            ->where('rfid_locations.tag_id', $tag_id)
            ->where('rfid_locations.status', 'active')
            ->firstOrFail();

      
        return view('rfids.show', compact('rfid'));
    }

    public function editByTagId($tag_id)
    {
        
        $rfid = Rfid::where('tag_id', $tag_id)->first();

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

    
}
