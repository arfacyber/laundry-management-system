FROM php:8.2-fpm

# Install system dependencies & Node.js
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

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

CMD php artisan config:cache && php artisan route:cache && service nginx start && php-fpm
# Trigger auto build
