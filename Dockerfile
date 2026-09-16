FROM php:8.3-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_pgsql gd intl bcmath mbstring zip opcache \
    && pecl install redis && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-progress --optimize-autoloader

COPY package.json package-lock.json* ./
RUN npm ci --no-audit --no-fund

COPY . .

RUN npm run build \
    && mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data \
               storage/framework/testing storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && ln -sfn /app/storage/app/public /app/public/storage \
    && php artisan config:cache \
    && php artisan view:cache

EXPOSE 8000

CMD ["sh", "-c", "php-fpm -D && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
