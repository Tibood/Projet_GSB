# ...existing code...
FROM php:8.2-fpm

# ...existing code...
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    mariadb-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier d'abord les fichiers composer pour profiter du cache Docker
COPY composer.json composer.lock* /var/www/html/

# Installer les dépendances PHP
RUN set -eux; \
    export COMPOSER_ALLOW_SUPERUSER=1; \
    composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-progress; \
    rm -rf /root/.cache/composer

# Copie du reste du projet
COPY . /var/www/html

# Attribution des droits
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exposition du port pour PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
# ...existing code...