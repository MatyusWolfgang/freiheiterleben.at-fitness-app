FROM php:8.3-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Composer installieren (offiziell + sauber)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Dependencies zuerst kopieren (Layer caching!)
COPY composer.json composer.lock* ./

RUN composer install --no-interaction --prefer-dist || true

# Rest vom Code
COPY . .

CMD ["php-fpm"]