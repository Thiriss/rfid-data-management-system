<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\MqttController;
class MqttListen extends Command
{
    protected $signature = 'mqtt:listen';
    protected $description = 'Listen to MQTT topic and process incoming messages';

    public function handle()
    {
        MqttController::MqttSubscribe();
       
        return Command::SUCCESS;
    }
}
