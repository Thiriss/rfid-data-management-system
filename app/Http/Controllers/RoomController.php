<?php

namespace App\Http\Controllers;
use App\Models\RfidLocation;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    public function index()
    {
        $locations = RfidLocation::select('location', DB::raw('COUNT(*) as total_items'))
        ->whereNotNull('location')
        ->groupBy('location')
        ->get();

        return view('locations.index', compact('locations'));
    }

    public function show($location)
    {
        $rfids = DB::table('rfids')
            ->join('rfid_locations', 'rfids.tag_id', '=', 'rfid_locations.tag_id')
            ->leftJoin('products', 'rfids.product_id', '=', 'products.id')
            ->where('rfid_locations.location', $location)
            ->select(
                'rfids.tag_id',
                'products.name as product_name',
                'products.category',
                'products.type',
                'products.size',
                'products.price'
            )
            ->get();

        return view('locations.show', compact('location', 'rfids'));
    }
}
