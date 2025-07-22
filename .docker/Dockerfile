FROM alpine:3.22

ARG user
ARG uid

ENV user=${user:-app}
ENV uid=${uid:-1000}

WORKDIR /var/www

RUN apk add --update --no-cache \
  nano curl bash \
    php84 php84-opcache php84-pgsql php84-pdo php84-pdo_pgsql \
    php84-sqlite3 php84-pdo_sqlite php84-curl php84-dom php84-xml \
    php84-xmlwriter php84-session php84-phar php84-fpm php84-openssl \
    php84-mbstring php84-tokenizer php84-fileinfo php84-intl php84-xmlreader \
    php84-zip php84-iconv && \
    ln -s /usr/bin/php84 /usr/local/bin/php && \
    ln -s /usr/sbin/php-fpm84 /usr/local/bin/php-fpm && \
    curl https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && rm composer-setup.php

RUN mkdir -p /var/www && adduser -D -G www-data -u $uid -h /var/www $user

RUN mkdir -p /scripts/docker-entrypoint.d
COPY ./.docker/entrypoint.sh /scripts/entrypoint.sh
RUN rm -rf ./.docker && chmod -R a+x /scripts/*.sh && \
    chown -R $user:www-data /var/log/php84 && \
    sed -i "s@listen = 127.0.0.1:9000@listen = 0.0.0.0:9000@g" /etc/php84/php-fpm.d/www.conf

# Create system user to run Composer and Artisan Commands
#RUN useradd -G www-data,root -u $uid -d /home/$user $user
#RUN chown -R $user:$user /home/$user

# Switch to system user
USER $user

ENTRYPOINT ["/scripts/entrypoint.sh"]

EXPOSE 9000 9000

CMD ["php-fpm", "-F"]
