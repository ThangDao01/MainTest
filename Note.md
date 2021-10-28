//Queue
- add thông tin mailtrap vào file env
  MAIL_MAILER=smtp
  MAIL_HOST=smtp.mailtrap.io
  MAIL_PORT=2525
  MAIL_USERNAME=2934dd441853ad
  MAIL_PASSWORD=48ec70b1200a9f
  MAIL_ENCRYPTION=tls

  QUEUE_CONNECTION=database

migrate :
php artisan queue:table
php artisan migrate:fresh

tạo 2 file Jobs & Mail
php artisan make:mail ...
php artisan make:job ...

terminal chạy lệnh 
php artisan queue:work


Cài đặt package jwt-auth

composer require tymon/jwt-auth

Mở composer.json lên và sửa lại phiên bản jwt thành:

"require": {
"tymon/jwt-auth": "1.0.0-rc.2"
},







