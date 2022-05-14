# Medical-office
This project is the production of a reporting web application. With this application users can visualize surveys and media and even read reports but only admin can add them. When adding a survey, they must answer a series of 64 questions and they can add comments or a media (image, audio, video, document) if needed. The platform would then display diagrams of the statistics of the company in each field.
to build follow steps:
Download Xampp composer https://www.apachefriends.org/fr/download.html
Create a mysql database locally named reporting
change the database credentials in config
Run composer install or php composer.phar install
Run php artisan key:generate
Run php artisan migrate
Run php artisan db:seed to run seeders, if any.
Run php artisan serve