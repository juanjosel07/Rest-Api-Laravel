# Usa una imagen oficial de PHP
FROM php:8.1-fpm

# Instalar dependencias de PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Copiar los archivos de tu aplicación al contenedor
WORKDIR /var/www
COPY . .

# Instalar dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto en el que la app se ejecutará
EXPOSE 9000

# Comando para ejecutar el servidor de Laravel
CMD ["php-fpm"]
