# Medical-office
this project consists of developing a web platform for medical practices in order to computerize and modernize the management of the appointments and the patient medical records and manage consultations.This application revolves around 4 axes:
❖ Appointment management
❖ Patient list management
❖ Consulting management
❖ Management of certificates and orders
to build follow steps:
Download Xampp composer https://www.apachefriends.org/fr/download.html
Create a mysql database locally named cabinet_medical
change the database credentials in config
Run composer install or php composer.phar install
Run php artisan key:generate
Run php artisan migrate
Run php artisan db:seed to run seeders, if any.
Run php artisan serve