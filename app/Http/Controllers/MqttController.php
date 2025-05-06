<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;
use PhpMqtt\Client\MqttClient;
use Illuminate\Support\Facades\Log;
use App\Events\MessageEvent;
use PhpMqtt\Client\Exceptions\MqttClientException;
use App\Jobs\StoreRfidLocation;
use App\Models\RfidLocation;
use App\Models\Rfid;
class MqttController extends Controller
{

    // public function TestQueueAndBroadcast()
    // {

    //         $message = '{"tag_id": "100", "location": "Room A"}';

    //         $data = json_decode($message, true);
    //         $checkId = Rfid::where('tag_id', $data['tag_id'])
    //         ->exists();
            
    //         if (!$checkId) {
    //             // Create new active record
    //             Rfid::create([
    //                 'tag_id' => $data['tag_id'],
    //                 'status' => 'active',
    //             ]);
    //         }
            
    //         StoreRfidLocation::dispatch($data);
    //         broadcast(new MessageEvent($data));
    //         return "success";

    // }

    public static function MqttSubscribe(){

         try {

            $mqtt = MQTT::connection();

            $topic = env('MQTT_TOPIC', 'rfid/ig');

            $mqtt->subscribe($topic, function (string $topic, string $message) use ($mqtt) {
                Log::info("Received: {$message}");

                try {
         
                    $data = json_decode($message, true);
                 
                    // Store in DB via Job
                    StoreRfidLocation::dispatch($data);
                    // Broadcast to frontend
                    broadcast(new MessageEvent($data));
                } catch (\Exception $e) {
                    Log::error('Failed to broadcast: ' . $e->getMessage());
                }

                // Optionally stop loop if needed
                // $mqtt->interrupt();
            }, MqttClient::QOS_AT_MOST_ONCE);

            $mqtt->loop(true); // non-blocking loop
            $mqtt->disconnect();
        } catch (MqttClientException $e) {
            Log::error("MQTT error: " . $e->getMessage());
            // $this->error("MQTT connection error.");
        }

    }
}
