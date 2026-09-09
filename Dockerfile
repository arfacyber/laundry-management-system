FROM php:8.2-fpm

# Install system dependencies & Node.js (Ditambahkan libpq-dev untuk PostgreSQL)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nginx libpq-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (Ditambahkan pdo_pgsql dan pgsql)
RUN docker-php-ext-install pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install PHP & Node dependencies, then build assets
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Configure Nginx
COPY docker/nginx.conf /etc/nginx/sites-available/default
EXPOSE 80

# RUNTIME EXECUTION: Bersihkan cache, buat folder wajib, atur perizinan, lalu nyalakan server
CMD php artisan optimize:clear || true && \
    mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache && \
    service nginx start && php-fpm