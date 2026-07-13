# Menggunakan image PHP 8.2 dengan Apache (kompatibel untuk Laravel 12)
FROM php:8.2-apache

# Instal dependensi sistem dan ekstensi PostgreSQL (untuk Neon.tech)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl

# Bersihkan cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instal ekstensi PHP yang dibutuhkan Laravel dan PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Aktifkan mod_rewrite Apache untuk routing Laravel
RUN a2enmod rewrite

# Atur working directory
WORKDIR /var/www/html

# Salin semua file proyek ke dalam kontainer
COPY . /var/www/html

# Instal Composer secara global
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Jalankan Composer untuk menginstal dependensi (tanpa dev package)
RUN composer install --optimize-autoloader --no-dev

# Atur perizinan folder (wajib agar Laravel bisa menulis log/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Ubah DocumentRoot Apache agar mengarah ke folder /public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Buka port 80
EXPOSE 80