# Instalar Breeze e rodar setup de autenticação web se não estiver instalado
if [ ! -f /var/www/routes/auth.php ]; then
  echo "Instalando Breeze (autenticação web)..."
  composer require laravel/breeze --dev --no-ansi --no-interaction --prefer-dist
  php artisan breeze:install
  npm install
  npm run build
  php artisan migrate --force
fi
# Garantir diretórios necessários do Laravel antes de comandos artisan
mkdir -p /var/www/storage/framework/views
mkdir -p /var/www/storage/framework/cache
mkdir -p /var/www/storage/framework/sessions
mkdir -p /var/www/storage/logs
touch /var/www/storage/logs/laravel.log
chown www-data:www-data /var/www/storage/logs/laravel.log
chmod 664 /var/www/storage/logs/laravel.log
#!/bin/bash

set -e

# Garantir diretório de views compiladas antes de qualquer comando artisan
mkdir -p /var/www/storage/framework/views
chmod -R 775 /var/www/storage/framework

# Corrigir erro de ownership do git para composer
git config --global --add safe.directory /var/www

# Instalar dependências PHP
if [ ! -d /var/www/vendor ]; then
  echo "Instalando dependências PHP (composer install) ..."
  composer install --no-ansi --no-interaction --prefer-dist
else
  echo "Atualizando dependências PHP (composer update) ..."
  composer update --no-ansi --no-interaction --prefer-dist
fi

# Instalar dependências Node.js
if [ ! -d /var/www/node_modules ]; then
  echo "Instalando dependências Node.js (npm ci) ..."
  npm ci
fi

# Buildar assets
echo "Buildando assets..."
npm run build

# Criar .env se não existir
if [ ! -f /var/www/.env ]; then
  echo ".env não encontrado, copiando .env.example para .env"
  cp /var/www/.env.example /var/www/.env
fi

# Gerar APP_KEY se não existir
if ! grep -q '^APP_KEY=' /var/www/.env || grep -q '^APP_KEY=$' /var/www/.env; then
  echo "Gerando APP_KEY..."
  php artisan key:generate --force
fi

# Executar migracoes
echo "Executando migracoes..."
php artisan migrate --force || true

# Limpar caches
echo "Limpando caches..."
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache


# Criar .env se não existir
if [ ! -f /var/www/.env ]; then
  echo ".env não encontrado, copiando .env.example para .env"
  cp /var/www/.env.example /var/www/.env
fi

# Arreglar permisos de storage y bootstrap
echo "Configurando permisos..."
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache
chmod 644 /var/www/storage/logs/*.log 2>/dev/null || true

# Garantir diretórios necessários do Laravel
mkdir -p /var/www/storage/framework/views
mkdir -p /var/www/storage/framework/cache
mkdir -p /var/www/storage/framework/sessions

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




# Arreglar permisos finales
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache

echo "LaraGym está listo!"

# Ejecutar comando pasado
exec "$@"
