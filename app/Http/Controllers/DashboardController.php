<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RfidLocation;

class DashboardController extends Controller
{
    public function index()
    {
        $rfidData = RfidLocation::where('status', 'active')
                    ->orderBy('id', 'asc')
                    ->latest()->take(20)->get();

        return view('dashboard', compact('rfidData'));
    }
}
