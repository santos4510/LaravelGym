# 🐳 Docker Setup - Guía Simplificada

## ⚡ 30 Segundos para Empezar

```bash
# 1. Copiar .env
cp .env.docker .env

# 2. Iniciar
docker compose up -d --build

```

**¡Listo!** Tu API está en **http://localhost:8000**

---

## 🌐 Accesos Inmediatos

| Servicio | URL | Usuario | Contraseña |
|----------|-----|---------|------------|
| **API** | http://localhost:8000 | - | - |
| **phpMyAdmin** | http://localhost:8080 | laravel | laravel |
| **Mailhog** | http://localhost:8025 | - | - |
| **SvelteKit Dev** | http://localhost:5173 | - | - |

---

## 📋 Comandos Comunes

### 🢙 Contenedores

```bash
docker compose ps                   # Ver estado
docker compose logs -f app          # Ver logs en vivo
docker compose down                 # Detener todo
docker compose up -d --build        # Reconstruir
```

### 🎵 Laravel

```bash
# Ejecutar comandos dentro del contenedor
docker exec laragym-app php artisan migrate          # Migrar BD
docker exec laragym-app php artisan cache:clear     # Limpiar cache
docker exec laragym-app php artisan test            # Ejecutar tests
docker exec laragym-app composer require vendor/pkg # Instalar paquete
```

### 📦 Node/npm

```bash
docker exec laragym-app npm install package       # Instalar paquete
docker exec laragym-app npm update                # Actualizar
docker exec laragym-app npm run build             # Build assets
```

### 🗄️ Base de Datos

```bash
# Conectar a MySQL
docker exec -it laragym-mysql mysql -u laravel -p -D laravel
# Contraseña: laravel

# Ver estado migraciones
docker exec laragym-app php artisan migrate:status

# Reset BD (⚠️ borra datos)
docker exec laragym-app php artisan migrate:fresh --seed
```

---

## 🔐 Endpoints de Autenticación API

Todas las rutas están en `/api/auth`:

```bash
# 📝 Registro
POST /api/auth/register
{ "name": "User", "email": "user@test.com", "password": "123456" }

# 🔑 Login
POST /api/auth/login
{ "email": "user@test.com", "password": "123456" }
# Retorna: { token: "xxx", token_type: "Bearer" }

# 🔄 Refresh
POST /api/auth/refresh
Authorization: Bearer <token>

# 🚪 Logout
POST /api/auth/logout
Authorization: Bearer <token>

# ✉️ Forgot Password
POST /api/auth/forgot
{ "email": "user@test.com" }

# 🔐 Reset Password
POST /api/auth/reset
{ "token": "xxx", "password": "newpass" }

# ✔️ Verify Email
POST /api/auth/verify
{ "hash": "xxx" }

# 📬 Resend Verification
POST /api/auth/resend
{ "email": "user@test.com" }
```

---

## 🏗️ Arquitectura

```
Tu Código Local
     ↓
     ├─→ /var/www (sincronizado)
     ├─→ vendor/ (volumen. no sincroniza)
     ├─→ node_modules/ (volumen. no sincroniza)
     └─→ storage/ (volumen. persistente)
     
Docker Containers
     ├── app (PHP 8.3 + Laravel 11)
     ├── nginx (puerto 8000)
     ├── mysql (puerto 3306)
     ├── redis (puerto 6379)
     ├── mailhog (puerto 8025)
     ├── phpmyadmin (puerto 8080)
     └── sveltekit (puerto 5173)
```

---

## 🐛 Problemas Comunes

### ❌ "Composer took too long" 
```bash
docker compose up -d --build --progress=plain
```

### ❌ "Connection to mysql failed"
```bash
docker compose restart mysql
docker exec laragym-app php artisan migrate
```

### ❌ "vendor/node_modules vacío"
```bash
docker compose down -v    # Elimina volúmenes
docker compose up -d --build  # Reconstruye
```

### ❌ "Ver qué pasó"
```bash
docker compose logs app | tail -50
```

---

## 📚 Documentación Completa

- **[FLUJO_INSTALACION.md](FLUJO_INSTALACION.md)** - Cómo se instalan las dependencias
- **[DOCKER_QUICKSTART.md](DOCKER_QUICKSTART.md)** - Guía detallada
- **[VERIFICACION_COMPLETA.md](VERIFICACION_COMPLETA.md)** - Checklist de verificación

---

## ✅ Verificación

```bash
# Ejecutar mediante script
bash verify-docker.sh           # Linux/Mac
.\verify-docker.ps1            # Windows PowerShell
```

El script verifica automáticamente:
- ✓ Contenedores corriendo
- ✓ Dependencias instaladas
- ✓ Volúmenes configurados
- ✓ Código sincronizado
- ✓ Laravel funcionando

---

**¿Problemas?** Lee la documentación completa en [DOCKER_QUICKSTART.md](DOCKER_QUICKSTART.md)
