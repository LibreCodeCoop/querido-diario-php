FROM php:7.4-fpm-alpine

RUN apk update

RUN apk add autoconf g++ make
RUN pecl install xdebug-2.9.8 \
    && docker-php-ext-enable xdebug

RUN apk add libpq && \
    # Build dependancies for PostgreSQL \
    apk add --update --no-cache --virtual .docker-php-postgresql-dependancies \
        postgresql-client \
        postgresql-dev && \
    docker-php-ext-configure pdo_pgsql && \
    docker-php-ext-configure pgsql && \
    docker-php-ext-install -j$(nproc) pdo_pgsql

RUN wget -q https://github.com/nikic/php-ast/archive/v1.0.4.zip \
    && unzip v1.0.4.zip \
    && cd php-ast-1.0.4 \
    && phpize \
    && ./configure \
    && make install \
    && echo 'extension=ast.so' > /usr/local/etc/php/php.ini \
    && cd .. && rm -rf php-ast-1.0.4 v1.0.4.zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
ENTRYPOINT ["sh", "/usr/local/bin/entrypoint.sh"]