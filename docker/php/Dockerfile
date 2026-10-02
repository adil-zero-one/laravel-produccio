FROM php:8.3-fpm-alpine

RUN apk add --no-cache nginx sqlite-libs

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    sqlite-dev \
    oniguruma-dev \
    && docker-php-ext-install -j2 pdo_sqlite mbstring \
    && apk del .build-deps

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf

RUN sed -i 's/fastcgi_pass 127.0.0.1:9000;/fastcgi_pass 127.0.0.1:9000;/' /etc/nginx/http.d/default.conf

EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
