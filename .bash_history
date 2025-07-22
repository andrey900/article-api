ls
composer install
composer install
php artisan migrate --step
cat /etc/php84/php-fpm.d/www.conf 
sudo sed -i "s@listen = 127.0.0.1:9000@listen = 0.0.0.0:9000@g" /etc/php84/php-fpm.conf 
sed -i "s@listen = 127.0.0.1:9000@listen = 0.0.0.0:9000@g" /etc/php84/php-fpm.conf 
sed -i "s@listen = 127.0.0.1:9000@listen = 0.0.0.0:9000@g" /etc/php84/php-fpm.conf
php artisan generate:key
php artisan key:generrate
