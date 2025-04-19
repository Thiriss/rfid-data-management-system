# Project setup requirements
# IOT Project
- PHP 8.4
- MySql ^8.0
- Python ^3

# Project setup
- Clone project repo. (git clone https://github.com/Thiriss/iot-project.git)
- Run 'composer install'
- Setup .env file
- Run 'php artisan migrate'

# Project Key generation command
- Set your application key. (php artisan key:generate)

# Basic project permission (optional)
- sudo chmod 775 -R storage/
- sudo chmod 775 -R bootstrap/cache
- sudo chmod -R 775 storage
- sudo chmod -R 775 bootstrap/cache

# Packages Installation
- composer require php-mqtt/laravel-client
  php artisan vendor:publish --provider="PhpMqtt\Client\MqttClientServiceProvider" --tag="config"
- composer require livewire/livewire
- composer require laravel/reverb
- composer update

# Clear config, events, routes, views
- php artisan optimize

# to install mqtt in python
- pip install paho-mqtt

# Create a virtual environment under the project
- python3 -m venv venv
# Activate the virtual environment
- source venv/bin/activate
- python mqtt_test.py (python file)

# Queue Worker Setup & Command artisan
- php artisan mqtt:listen
- php artisan queue:restart
- php artisan queue:work

# Read-time data update & Real-time WebSocket communication 
- php artisan install:broadcasting
- composer require laravel/reverb
- php artisan reverb:install 

# Real-time data update for interfaces (frontent)
- npm install --save-dev laravel-echo pusher-js
- npm run build
- npm run dev

# Commands to Run Concurrently

- php artisan serve
- php artisan reverb:start --debug
- python mqtt_test.py 
- php artisan mqtt:listen
- php artisan queue:work
- npm run dev
