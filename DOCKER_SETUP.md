# LaraGym Docker Setup Guide

## Requisitos Previos
- Docker Desktop instalado
- Docker Compose instalado

## Estructura de la Aplicación Docker

```
app (PHP-FPM 8.2)
  ↓
nginx (Alpine)
  ↓
mysql (8.0)
  ↓
redis (Alpine)
  ↓
mailhog (Desarrollo-only)
```

## Pasos para Ejecutar

### 1. Preparar el Proyecto
```bash
# Copiar el archivo .env
cp .env.example .env

# O si ya existe, verificar que los valores sean correctos:
# DB_HOST=mysql
# DB_DATABASE=laragym
# DB_USERNAME=laragym
# DB_PASSWORD=laragym_password
```

### 2. Construir las Imágenes
```bash
docker-compose build
```

### 3. Iniciar los Contenedores
```bash
docker-compose up -d
```

El script `docker-entrypoint.sh` ejecutará automáticamente:
- Generación de APP_KEY (si falta)
- Migraciones de base de datos
- Limpieza de caches

### 4. Verificar que Todo Está Funcionando
```bash
# Verificar contenedores activos
docker-compose ps

# Ver logs de la aplicación
docker-compose logs -f app

# Probar la aplicación
curl http://localhost:8000
```

## Puertos Expuestos

| Servicio   | Puerto | URL                      |
|-----------|--------|--------------------------|
| Nginx     | 8000   | http://localhost:8000    |
| MySQL     | 3306   | localhost:3306          |
| Redis     | 6379   | localhost:6379          |
| Mailhog   | 8025   | http://localhost:8025   |

## Comandos Útiles

### Artisan Commands
```bash
# Ejecutar un comando artisan
docker-compose exec app php artisan tinker

# Ver estado de migraciones
docker-compose exec app php artisan migrate:status

# Ejecutar seeders
docker-compose exec app php artisan db:seed
```

### Acceder a la Base de Datos
```bash
# MySQL CLI
docker-compose exec mysql mysql -u laragym -p laragym

# Ver logs de MySQL
docker-compose logs mysql
```

### Logs
```bash
# Ver todos los logs
docker-compose logs -f

# Ver logs específicos
docker-compose logs -f app
docker-compose logs -f nginx
docker-compose logs -f mysql
```

### Detener y Limpiar
```bash
# Detener contenedores
docker-compose down

# Eliminar volúmenes (cuidado: borra la BD)
docker-compose down -v

# Reconstruir todo desde cero
docker-compose down -v && docker-compose build --no-cache && docker-compose up -d
```

## Solución de Problemas

### Error: "Connection refused" en MySQL
- Verificar que MySQL esté listo: `docker-compose logs mysql`
- El script espera 30 segundos a que MySQL inicie. Si toma más, aumentar el timeout en `docker-entrypoint.sh`

### Error: "Permission denied" en storage/logs
- Es normal en primera ejecución. El contenedor configura permisos automáticamente.

### Cambios en el código no se reflejan
- Los archivos están sincronizados con volúmenes. Para PHP-FPM cambios:
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear
```

### Reconstruir sin caché
```bash
docker-compose build --no-cache && docker-compose up -d
```

## Estructura de Servicios

### app (PHP-FPM)
- Imagen: `php:8.2-fpm-alpine`
- Ejecuta: `php-fpm`
- Volúmenes: Toda la aplicación en `/var/www`
- Red: laravel

### nginx
- Imagen: `nginx:alpine`
- Proxy a PHP-FPM en `app:9000`
- Configurable en `nginx.conf`
- Puerto: 8000

### mysql
- Imagen: `mysql:8.0`
- Usuario: `laragym`
- BD: `laragym`
- Contraseña: `laragym_password` (configurar en .env)
- Almacenamiento: `./storage/mysql`

### redis
- Imagen: `redis:alpine`
- Puerto: 6379
- Usado para CACHE, QUEUE y BROADCAST

### mailhog
- Interfaz: http://localhost:8025
- Captura todos los emails en desarrollo

## Flujo de Trabajo

1. Código local → Volúmenes Docker
2. nginx recibe requests en puerto 8000
3. nginx proxy a PHP-FPM en app:9000
4. PHP procesa con Laravel
5. Laravel conecta a MySQL a través del nombre de servicio `mysql`
6. Redis para caché/queue/broadcast
7. Mailhog captura emails

## Variables de Entorno en Docker

Las siguientes variables se sobrescriben en `docker-compose.yml`:
- `DB_HOST=mysql` (nombre del servicio)
- `REDIS_HOST=redis`
- `MAIL_HOST=mailhog`

Las demás se cargan del archivo `.env`

## Tips de Optimización

### Para desarrollo
- Aumentar `LOG_LEVEL=debug` en .env
- Usar `CACHE_DRIVER=file` si tienes problemas con Redis
- Mantener `APP_DEBUG=true`

### Para producción
- Cambiar `APP_ENV=production`
- Cambiar `APP_DEBUG=false`
- Usar `CACHE_DRIVER=redis`
- Cambiar `QUEUE_CONNECTION=redis`
