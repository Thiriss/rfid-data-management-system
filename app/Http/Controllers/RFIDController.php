<?php

namespace App\Http\Controllers;
use App\Jobs\SubscribeToMqttJob;
use App\Models\Rfid; // Add this line to use the Rfid model
use Illuminate\Support\Facades\Log;

class RFIDController extends Controller
{
    
    public function index()
    {
        // Dispatch the job to run in the background
        SubscribeToMqttJob::dispatch();

        // Retrieve all RFID data from the database
        $rfidData = Rfid::all();

        // Pass the data to the view
        return view('rfids.index', compact('rfidData'));
    }
}
