# Imagen base PHP + Apache
FROM php:8.2-apache

# Paquetes del sistema y extensiones PHP necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev libzip-dev zip \
 && docker-php-ext-install pdo pdo_mysql mbstring bcmath exif pcntl \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

# Composer (copiamos el binario desde la imagen oficial)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Carpeta de trabajo
WORKDIR /var/www/html

# Copiar código
COPY . /var/www/html

# DocumentRoot → public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Instalar dependencias PHP del proyecto
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction

# Limpiar/optimizar cachés básicos
RUN php artisan config:clear && php artisan route:clear

# Permisos para cache y logs
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Apache en 8080 (Render lo espera)
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 8080

# Arranque del servidor web
CMD ["apache2-foreground"]
