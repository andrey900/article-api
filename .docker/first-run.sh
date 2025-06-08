#! /bin/sh

main() {
    cd /var/www
    if [ -f /tmp/.fr ]; then
        composer install
        composer dump-autoload
        touch /tmp/.fr
        php artisan key:generate; php artisan migrate --step --seed
        npm install
    fi
}


echo "First run $(date)"

if [ -f /tmp/.fr ]; then
    echo "App Inited!"
    exit 0
fi

if [ $PRIMARY == "1" ]; then
    main
fi

main
