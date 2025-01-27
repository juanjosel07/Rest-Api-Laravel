#!/usr/bin/env bash
echo "Ejecutando composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "generando clave de aplicación..."
php artisan key:generate --show

echo "Almacenando en caché la configuración..."
php artisan config:cache

echo "Almacenando en caché las rutas..."
php artisan route:cache

echo "Ejecutando migraciones..."
php artisan migrants --force
