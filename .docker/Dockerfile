FROM php:8.4-fpm-alpine

ARG user
ARG uid

ENV user=${user:-app}
ENV uid=${uid:-1000}

WORKDIR /var/www

RUN apk update && apk add --no-cache \
    autoconf \
    gcc \
    g++ \
    make \
    libtool \
    pcre-dev

RUN apk add --no-cache shadow bash autoconf g++ make icu-dev libpq-dev oniguruma-dev libzip-dev libxml2-dev \
    libpq-dev libpng-dev curl-dev zlib-dev postgresql-dev python3 nodejs npm

RUN docker-php-ext-install gd zip pdo mysqli pdo_mysql pdo_pgsql mbstring exif pcntl bcmath intl opcache ctype fileinfo xml && \
    docker-php-ext-enable bcmath mysqli pdo_mysql pdo_pgsql ctype fileinfo xml gd

RUN mkdir /app && adduser -D -G www-data -u $uid -h /app $user && \
    cd /bin && curl -s https://getcomposer.org/installer | php && mv composer.phar /bin/composer

RUN mkdir -p /scripts/docker-entrypoint.d
COPY ./.docker/entrypoint.sh /scripts/entrypoint.sh

# Create system user to run Composer and Artisan Commands
#RUN useradd -G www-data,root -u $uid -d /home/$user $user
#RUN chown -R $user:$user /home/$user

# Switch to system user
USER $user

ENTRYPOINT ["/scripts/entrypoint.sh"]

CMD ["php-fpm"]
