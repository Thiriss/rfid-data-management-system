<?php
namespace App\Jobs;

use App\Models\RfidLocation;
use App\Models\Rfid;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
class StoreRfidLocation implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $data;

    public function __construct(array $data)
    {

        $this->data = $data;

    }

    public function handle(): void
    {
        $checkId = Rfid::where('tag_id', $this->data['tag_id'])
        ->exists();

        if (!$checkId) {
            // Create new active record
            Rfid::create([
                'tag_id' => $this->data['tag_id'],
                'status' => 'active',
            ]);
        }
        // Check if there's already an active row with same RFID and same location
        $exists = RfidLocation::where('tag_id', $this->data['tag_id'])
            ->where('location',  $this->data['location'])
            ->where('status', 'active')
            ->exists();

        if (!$exists) {
            // If not same location, deactivate all other active records for this RFID
            RfidLocation::where('tag_id', $this->data['tag_id'])
                ->where('status', 'active')
                ->update(['status' => 'inactive']);

            // Create new active record
            RfidLocation::create([
                'tag_id' => $this->data['tag_id'],
                'location' =>  $this->data['location'],
                'status' => 'active',
            ]);
        }

    }
}

