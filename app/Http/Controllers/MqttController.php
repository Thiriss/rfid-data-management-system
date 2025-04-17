<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;
use PhpMqtt\Client\MqttClient;
use Illuminate\Support\Facades\Log;
use App\Events\MessageReceived;
use PhpMqtt\Client\Exceptions\MqttClientException;
use App\Jobs\StoreRfidLocation;
use App\Models\RfidLocation;
class MqttController extends Controller
{
    public static function MqttSubscribe(){

            // $data =  [ 
            //          "rfid" => "3",
            //         "location" => "Room E"
            // ];

           //  $message = '{"rfid": "2", "location": "Room E"}';

           //  // StoreRfidLocation::dispatch($data);
           // broadcast(new MessageReceived($message));



         try {

            $mqtt = MQTT::connection();

            $topic = env('MQTT_TOPIC', 'rfid/location');

            $mqtt->subscribe($topic, function (string $topic, string $message) use ($mqtt) {
                Log::info("Received: {$message}");

                try {
         
                    $data = json_decode($message, true);
                 
                    // Store in DB via Job
                    // StoreRfidLocation::dispatch($data);
                    StoreRfidLocation::dispatch($data);
                    // Broadcast to frontend
                    // broadcast(new MessageReceived($message));
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
