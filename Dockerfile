FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libsqlite3-dev curl \
    && docker-php-ext-install pdo_sqlite mbstring zip exif pcntl bcmath gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Buat file database SQLite & jalankan migrasi + seeder otomatis
RUN mkdir -p database && touch database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache database

CMD php artisan migrate --seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}