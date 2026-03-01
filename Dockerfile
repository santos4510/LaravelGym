FROM php:8.3-fpm-alpine

RUN apk update && apk upgrade --no-cache \
    && apk add --no-cache \
        bash \
        git \
        curl \
        unzip \
        nodejs \
        npm \
        libpng-dev \
        libzip-dev \
        libxml2-dev \
        oniguruma-dev \
        zlib-dev \
        icu-dev \
        netcat-openbsd \
        imagemagick-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        zip \
        xml \
        gd \
        intl \
        bcmath \
        fileinfo \
        opcache

# Instala extensión Redis
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps

# Instala Imagick
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apk del .build-deps

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN mkdir -p storage/logs bootstrap/cache \
    && mkdir -p storage/framework/{cache,sessions,views} \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && find storage -type f -exec chmod 664 {} \; \
    && find bootstrap/cache -type f -exec chmod 664 {} \;


# Copiar el script de entrada  
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]

CMD ["php-fpm"]

