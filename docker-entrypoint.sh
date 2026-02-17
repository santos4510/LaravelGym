#!/bin/bash

set -e

# Arreglar permisos de storage y bootstrap
echo "Configurando permisos..."
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache
chmod 644 /var/www/storage/logs/*.log 2>/dev/null || true

# Crear archivo de log si no existe
mkdir -p /var/www/storage/logs
touch /var/www/storage/logs/laravel.log
chown www-data:www-data /var/www/storage/logs/laravel.log
chmod 664 /var/www/storage/logs/laravel.log

# Esperar a que MySQL esté listo
echo "Esperando MySQL..."
while ! nc -z mysql 3306 2>/dev/null; do
  sleep 1
done
echo "MySQL está listo!"

# Generar APP_KEY si no existe
if [ -z "$APP_KEY" ]; then
    echo "Generando APP_KEY..."
    php artisan key:generate --force
fi

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force || true

# Limpiar caches
echo "Limpiando caches..."
php artisan config:cache
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Arreglar permisos finales
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache

echo "LaraGym está listo!"

# Ejecutar comando pasado
exec "$@"
