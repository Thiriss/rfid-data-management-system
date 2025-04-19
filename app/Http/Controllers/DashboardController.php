<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RfidLocation;
use App\Models\Rfid;
class DashboardController extends Controller
{
    public function index()
    {
        $rfidData = RfidLocation::where('status', 'active')
                    ->orderBy('id', 'asc')
                    // ->latest()->take(20)
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
                ->firstOrFail();
    
        return view('rfids.show', compact('rfid'));
    }
}
