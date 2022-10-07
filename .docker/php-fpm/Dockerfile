FROM php:8.0-fpm-alpine

COPY wait-for-it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it

RUN apk --no-cache update && apk add pcre-dev ${PHPIZE_DEPS} libxml2-dev gmp-dev icu-dev && \
apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev

# Install igbinary
RUN pecl install igbinary && docker-php-ext-enable igbinary

# Install redis with igbinary and lzf support
RUN mkdir -p /usr/src/php/ext && cd /usr/src/php/ext && \
    pecl bundle redis && \
    docker-php-ext-configure redis --enable-redis-igbinary --enable-redis-lzf && \
    docker-php-ext-install redis

# Enable php deps
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install soap bcmath gmp intl pdo_mysql opcache gd

# Install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/teste-dev

CMD composer install ; wait-for-it mariadb:3306 -- bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration ;  php-fpm

RUN chown -R www-data:www-data /var/www/teste-dev
