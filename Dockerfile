FROM php:8.2-cli

# Install ekstensi PHP (termasuk pdo_pgsql) & Node.js untuk Vite/Tailwind
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev curl \
    && docker-php-ext-install pdo_pgsql mbstring zip exif pcntl bcmath gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install dependensi PHP & build aset frontend
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Jalankan migrasi + seeder otomatis & nyalakan server
CMD php artisan migrate --seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}