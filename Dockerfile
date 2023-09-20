FROM composer:latest as build
WORKDIR /app
COPY . /app

RUN composer install --ignore-platform-reqs

FROM php:8.1.9-fpm
COPY --from=build /app /app
WORKDIR /app

# Supervisor config
RUN echo "set -e \nif [ \"\$1\" != \"\" ]; then\n    exec "\$@"\nelse\n    exec /usr/bin/supervisord -c /app/supervisord.conf\nfi" >> /app/entrypoint.sh

# Install tools
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -yqq; \
    pecl channel-update pecl.php.net && \
    apt-get install -yqq --no-install-recommends \
    nginx \
    supervisor \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libpng-dev \
    zlib1g-dev \
    vim \
    default-mysql-client

RUN sed -i 's/DEFAULT@SECLEVEL=2/DEFAULT@SECLEVEL=1/g' /etc/ssl/openssl.cnf
RUN sed -i 's/DEFAULT@SECLEVEL=2/DEFAULT@SECLEVEL=1/g' /usr/lib/ssl/openssl.cnf

# Install important docker dependencies
RUN docker-php-ext-install pdo_mysql bcmath pcntl

# Install redis
RUN pecl install -o -f redis && \
 echo "extension=redis.so" > /usr/local/etc/php/conf.d/docker-php-ext-redis.ini && \
 rm -rf /tmp/pear

########################################################

COPY ./.env.example ./.env

RUN php artisan optimize:clear && \
    php artisan key:generate

RUN chown -R www-data:www-data /app
RUN chmod 777 -R /app/storage /app/bootstrap/cache

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

COPY ./nginx.conf /etc/nginx/sites-enabled/default

EXPOSE 9000
ENTRYPOINT ["sh", "/app/entrypoint.sh"]
