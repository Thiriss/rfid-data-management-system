<?php

namespace App\Jobs;

use App\Models\Rfid;
use Bluerhinos\phpMQTT;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SubscribeToMqttJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public $tries = 1; // Only try once

    public function handle()
    {
        // MQTT Broker Details
        $server = 'broker.hivemq.com';
        $port = 1883;
        $client_id = 'laravel_subscriber_' . uniqid(); // Unique client ID

        // Create MQTT Client
        $mqtt = new phpMQTT($server, $port, $client_id);

        if ($mqtt->connect()) {
            Log::info("Connected to MQTT broker.");

            // Subscribe to both topics
            $topics = [
                'rfid/location1' => ['qos' => 0, 'function' => function($topic, $msg) {
                    $this->handleMqttMessage($msg);
                }],
                'rfid/location2' => ['qos' => 0, 'function' => function($topic, $msg) {
                    $this->handleMqttMessage($msg);
                }]
            ];
            $mqtt->subscribe($topics);

            // Process incoming messages continuously
            while ($mqtt->proc()) {}

            $mqtt->close();
        } else {
            Log::error("Failed to connect to MQTT broker.");
        }
    }

    private function handleMqttMessage($msg)
    {
        $data = json_decode($msg, true);
        Log::info('Received data: ' . print_r($data, true));

        // Save to database if valid
        if (isset($data['rfid']) && isset($data['location'])) {
            Rfid::create([
                'rfid' => $data['rfid'],
                'location' => $data['location'],
            ]);
        } else {
            Log::warning('Invalid data received: ' . print_r($data, true));
        }
    }
}
