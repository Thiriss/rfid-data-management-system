## to run the system

php artisan serve
npm run dev
php artisan reverb:start --debug
php artisan queue:work

php artisan migrate

php artisan db:seed --class=ProductSeeder
## to install mqtt in laravel
composer require bluerhinos/phpmqtt dev-master


## to install mqtt in python
pip install paho-mqtt

php artisan mqtt:listen
php artisan queue:work

php artisan serve --host=0.0.0.0 --port=8000

